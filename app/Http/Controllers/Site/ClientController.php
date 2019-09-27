<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Site\ClientStoreRequest;
use App\Http\Requests\Site\ClientInfoStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\All\Client;
use App\Models\Panel\Plan;
use App\Models\Panel\Profission;
use App\Traits\Price;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    use Price;

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $conf = DB::table('configurations')->first();

        $plans = Plan::with('modality')->get();

        $abrangencias = [];

        foreach ($plans as $plan) {
            $abrangencias[$plan->abrangencia] = 'Nacional';

            if ($plan->abrangencia == 2) {
                $abrangencias[$plan->abrangencia] = 'Regional';
            }
        }

        $abrangencias = json_encode($abrangencias);

        $appUrl = env('APP_URL');

        if (!$plans)
            return redirect('/')->withErrors(['Não temos planos cadastrados no momento. Volte mais tarde.']);

        $modalities = [];

        foreach ($plans as $plan) {

            $modalities[$plan->modality->id] = $plan->modality->name;

        }

        return view('site.plans.index', compact('conf', 'modalities', 'appUrl', 'abrangencias'));
    }

    public function store(ClientStoreRequest $request) {
        $data = $request->all();

        $client = $this->client->create($data);

        $clientId = base64_encode($client->id);

        if ($client)
            return redirect("/planos/informacoes/{$clientId}");
        else
            return redirect("/planos")->withErrors(['Ocorreu um erro ao enviar as informações. Tente novamente']);

    }

    public function info($id)
    {
        $clieneId = base64_decode($id);

        $client = $this->client::with('state', 'city', 'modality.plans.elegibilidade.profissions')->where('id', $clieneId)->get()->first();

        $profissions = $this->getProfissionsByModality($client->modality);

        $date = new Datetime;

        $maxDate = $date->format('Y-m-d');

        $date->modify('-100 years');

        $minDate = $date->format('Y-m-d');

        if (!$client)
            return redirect('/planos')->withErrors(['A informações apresentação não confereme em nosso sistema.']);

        return view('site.plans.info', compact('client', 'id', 'profissions', 'maxDate', "minDate"));
    }

    public function infoStore(ClientInfoStoreRequest $request)
    {
        $data = $request->all();


        // --- VERIFICATION ---

        if (empty($data['id']))
            return redirect('/planos')->withErrors(['Não foi informada uma identificação']);

        $id = base64_decode($data['id']);

        $client = $this->client::with('state', 'city')->where('id', $id)->get()->first();

        if (!$client)
            return redirect('/planos')->withErrors(['Os dados informados não constam em nosso sistema']);

        if (!empty($data['dependents']) && count($data['dependents'])) {

            foreach ($data['dependents'] as $key => $dependent) {

                if (empty($dependent))
                    unset($data['dependents'][$key]);

            }

            if (empty($data['dependents']))
                unset($data['dependents']);
        }

        if (empty($data['dependents']))
            return redirect()->back()->withInput()->withErrors(['É necessário colocar mais um data de nascimento para o funcionário']);

        if (count($data['dependents']) > 28)
            return redirect()->back()->withInput()->withErrors(['Solicite orçamento para até para 29 pessoas no total']);

        // --- END VERIFICATION ---


        $update = $client->update($data);

        if (!empty($data['dependents'])) {
            foreach ($data['dependents'] as $birth) {

                $createDependent['client_id'] = $id;

                $createDependent['birth'] = $birth;

                DB::table('dependents')->insert($createDependent);
            }
        }

        if (!$update)
            return redirect('/planos')->withErrors(['Ocorreu um erro interno. Por favor tente novamente']);

        return redirect('/planos/visualizar/' . $data['id']);
    }

    public function showPlans($id)
    {
        $clientId = base64_decode($id);

        $client = $this->client::with('dependents', 'profission', 'state', 'city')
                                    ->where(['id' => $clientId])
                                    ->get()
                                    ->first();
        //

        $plans = $this->getPlansForClient($client);

        $operadoras = $this->getOperadorasFromPlans($plans);

        $clientAge = $this->calculateAgePerson($client->birth);

        $pricesClient = $this->calculatePricesPlansOfPerson($clientAge, $plans);

        $finalPricesDependents = [];

        if ($client->dependents()->count() > 0) {

            $dependentsAges = $this->calculateAgesDependents($client->dependents);

            $pricesDependents = $this->calculatePricesOfDependents($dependentsAges, $plans);

            $finalPricesDependents = $this->sumPricesDependentsByAges($pricesDependents);

            $finalPricesDependents = $this->formartFinalPricesDependents($finalPricesDependents);

            $finalPrices = $this->sumPricesClientAndDependents($pricesClient, $pricesDependents);

        } else {

            $finalPrices = $this->getFinalPricesFromPlansClient($pricesClient);

        }

        $pricesPlansClient = $this->getPricesPlansClient($pricesClient);

        $totalPricesPlans = $this->formatPriceToView($finalPrices);

        $conf = DB::table('configurations')->first();

        return view('site.plans.view', compact('client', 'operadoras', 'plans', 'clientAge', 'pricesPlansClient', 'finalPricesDependents', 'totalPricesPlans', 'conf'));
    }

    public function sendEmail(Request $request)
    {

        $data = $request->all();

        $client = $this->client::select('id', 'name', 'phone', 'email')->where('id', $data['id'])->get()->first();

        $dataClient['id'] = $client->id;
        $dataClient['name'] = $client->name;
        $dataClient['email'] = $client->email;
        $dataClient['phone'] = $client->phone;

        Mail::send('mails.plan-client', compact('dataClient'), function($message) use($client) {

            $message->to(env('MAIL_CONTACT_ADDRESS'));
            $message->subject('[PLANO] Solicitação de Plano - ' . $client->name);

        });

        return redirect('/planos/recebido');

    }

    public function emailReceived()
    {
        return view('site.plans.mail-received');
    }

    private function getProfissionsByModality($modality)
    {

        $profissions = [];

        if (empty($modality->elegibilidade))
            return json_encode($profissions);


        foreach ($modality->plans as $plan) {

            foreach ($plan->elegibilidade->profissions as $profission) {

                $profissions[$profission->id] = $profission->name;

            }
        }

        $profissions = json_encode($profissions);

        return $profissions;

    }

    private function getPlansForClient($client)
    {
        $elegibilidades = $this->getElegibilidadeFromClient($client);

        if ($client->abrangencia == '1') {

            if (!empty($elegibilidades) && $elegibilidades->count()) {
                $i = 0;

                foreach ($elegibilidades as $elegibilidade) {
                    $plans[$i] = Plan::with('operadora', 'ages')
                            ->where('modality_id', $client->modality_id)
                            ->where('elegibilidade_id', $elegibilidade->id)
                            ->where('abrangencia', $client->abrangencia)
                            ->get();

                    $i++;
                }

            } else {
                $plans[0] = Plan::with('operadora', 'ages')
                            ->where('modality_id', $client->modality_id)
                            ->where('abrangencia', $client->abrangencia)
                            ->get();
            }
        } else {

            if (!empty($elegibilidades) && $elegibilidades->count()) {

                $i = 0;

                foreach ($elegibilidades as $elegibilidade) {
                    $plans[$i] = Plan::with(['operadora', 'ages'])
                                ->where('modality_id', $client->modality_id)
                                ->where('elegibilidade_id', $elegibilidade->id)
                                ->where('abrangencia', $client->abrangencia)
                                ->where('state_id', $client->state_id)
                                ->whereHas('cities', function ($query) use ($client) {
                                    $query->where('city_id', $client->city_id);
                                })
                                ->get();

                    $i++;
                }
            } else {
                $plans[0] = Plan::with(['operadora', 'ages'])
                            ->where('modality_id', $client->modality_id)
                            ->where('abrangencia', $client->abrangencia)
                            ->where('state_id', $client->state_id)
                            ->whereHas('cities', function ($query) use ($client) {
                                $query->where('city_id', $client->city_id);
                            })
                            ->get();
            }
        }

        $plans = $this->getPlansFromInside($plans);

        return $plans;
    }

    private function getElegibilidadeFromClient($client)
    {
        $elegibilidades = '';

        if (!empty($client->profission_id)) {
            $profission = Profission::with('elegibilidades')->where('id', $client->profission_id)->get()->first();

            $elegibilidades = $profission->elegibilidades;
        }

        return $elegibilidades;
    }

    private function getPlansFromInside($plans)
    {
        $plansOut = [];

        foreach ($plans as $plan) {
            foreach ($plan as $p) {
                $plansOut[] = $p;
            }
        }

        return $plansOut;
    }

    private function getOperadorasFromPlans($plans)
    {
        $operadoras = [];

        foreach ($plans as $plan) {

            $operadoras[$plan->operadora->id] = $plan->operadora->name;

        }

        return $operadoras;
    }

    private function calculateAgePerson($birth)
    {
        $personBirth = new DateTime($birth);

        $today = new DateTime('now');

        $diffBirthToday = $personBirth->diff($today);

        $personAge = $diffBirthToday->y;

        return $personAge;
    }

    private function calculateAgesDependents($dependents)
    {
        $agesDependents = [];

        if (count($dependents) > 0)
        {
            foreach ($dependents as $dependent) {
                $agesDependents[] = $this->calculateAgePerson($dependent->birth);
            }
        }

        return $agesDependents;
    }

    private function calculatePricesPlansOfPerson($personAge, $plans)
    {
        $prices = [];

        foreach ($plans as $plan) {

            $prices[$plan->id]['age_name'] = '';
            $prices[$plan->id]['age_id'] = '';
            $prices[$plan->id]['price'] = 0;

            foreach($plan->ages as $age) {

                if ($age->initial_age -1 < $personAge && $age->final_age + 1 > $personAge) {

                    $prices[$plan->id]['age_name'] = $age->name;
                    $prices[$plan->id]['age_id'] = $age->id;
                    $prices[$plan->id]['price'] = $age->pivot->price;

                }

            }

        }

        return $prices;
    }

    private function calculatePricesOfDependents($dependentsAges, $plans)
    {
        $prices = [];

        if (count($dependentsAges) > 0) {

            foreach ($dependentsAges as $age) {

                $prices[] = $this->calculatePricesPlansOfPerson($age, $plans);

            }

        }

        return $prices;
    }

    private function sumPricesDependentsByAges($dependents)
    {
        $finalPricesDependents = [];

        foreach ($dependents as $dependent) {

            foreach ($dependent as $idPlanDependent => $values) {

                $finalPricesDependents[$idPlanDependent][$values['age_id']]['name'] = '';
                $finalPricesDependents[$idPlanDependent][$values['age_id']]['qtd'] = 0;
                $finalPricesDependents[$idPlanDependent][$values['age_id']]['price'] = 0;

            }

        }

        foreach ($dependents as $dependent) {

            foreach ($dependent as $idPlanDependent => $values) {

                $finalPricesDependents[$idPlanDependent][$values['age_id']]['name'] = $values['age_name'];
                $finalPricesDependents[$idPlanDependent][$values['age_id']]['qtd']++;
                $finalPricesDependents[$idPlanDependent][$values['age_id']]['price'] += $values['price'];

            }

        }

        return $finalPricesDependents;
    }

    private function formartFinalPricesDependents($finalPricesDependents)
    {

        foreach ($finalPricesDependents as $idPlan => $pricesAges) {

            foreach ($pricesAges as $idAge => $priceAge) {

                $price = $this->formatPriceToView($priceAge['price']);

                $finalPricesDependents[$idPlan][$idAge]['price'] = $price[0];
            }
        }

        return $finalPricesDependents;
    }

    private function sumPricesClientAndDependents($pricesClient, $pricesDependents)
    {
        $finalPrices = [];

        foreach ($pricesClient as $idPlanClient => $valuesClient) {

            $finalPrices[$idPlanClient] = $valuesClient['price'];

            foreach ($pricesDependents as $pricesDependent) {

                foreach ($pricesDependent as $idPlanDependent => $valuesDependents) {

                    if ($idPlanClient == $idPlanDependent) {

                        $finalPrices[$idPlanClient] += $valuesDependents['price'];
                    }

                }

            }

        }

        return $finalPrices;

    }

    private function getFinalPricesFromPlansClient($pricesClient)
    {

        $finalPrices = [];

        foreach ($pricesClient as $idPlan => $priceClient) {

            $finalPrices[$idPlan] = $priceClient['price'];

        }

        return $finalPrices;

    }

    private function getPricesPlansClient($pricesClient)
    {
        $pricesPlansClient = [];

        foreach ($pricesClient as $idPlan => $values) {

            $price = $this->formatPriceToView($values['price']);

            $pricesPlansClient[$idPlan] = $price[0];

        }

        return $pricesPlansClient;

    }
}
