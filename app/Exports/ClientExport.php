<?php

namespace App\Exports;

use DateTime;
use App\Models\All\Client;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClientExport implements FromArray, WithHeadings, WithEvents, ShouldAutoSize
{

    public function array(): array
    {
        $clients = Client::select(
                            'id',
                            'state_id',
                            'city_id',
                            'modality_id',
                            'profission_id',
                            'name',
                            'phone',
                            'email',
                            'birth',
                            'abrangencia')->with('state', 'city', 'modality', 'profission')->get();

        $arrayClients = $this->formatClientsToArray($clients);

        return $arrayClients;
    }

    public function registerEvents(): array
    {
        $styleArray = [
            'font' => [
                'bold' => true,
            ]
        ];

        return [
            AfterSheet::class => function (AfterSheet $event) use($styleArray) {
                $event->sheet->getStyle('A1:M1')->applyFromArray($styleArray);
            }
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nome',
            'Telefone',
            'E-mail',
            'Dt. Nascimento',
            'Idade',
            'Modalidade',
            'Profissão',
            'Abrangência',
            'Estado',
            'Cidade',
            'Dependentes',
            'Dt. Nasc. Dependentes',
        ];
    }

    private function formatClientsToArray($clients)
    {
        $arrayClients = [];

        foreach ($clients as $client) {

            $arrayClients[$client->id]['id'] = $client->id;
            $arrayClients[$client->id]['name'] = $client->name;
            $arrayClients[$client->id]['phone'] = $client->phone;
            $arrayClients[$client->id]['email'] = $client->email;

            if (!empty($client->birth)) {

                $birth = new DateTime($client->birth);
                $today = new DateTime('now');
                $diff = $birth->diff($today);

                $arrayClients[$client->id]['birth'] = $birth->format('d/m/Y');
                $arrayClients[$client->id]['age'] = $diff->y;

            } else {

                $arrayClients[$client->id]['birth'] = '';
                $arrayClients[$client->id]['age'] = '';

            }

            $arrayClients[$client->id]['modality'] = $client->modality->name;

            $arrayClients[$client->id]['profission'] = !empty($client->profission_id) ? $client->name : '';

            if ($client->abrangencia == 1)
                $arrayClients[$client->id]['abrangencia'] = 'Nacional';

            elseif ($client->abrangencia == 2)
                $arrayClients[$client->id]['abrangencia'] = 'Regional';

            else
                $arrayClients[$client->id]['abrangencia'] = '-';

            $arrayClients[$client->id]['state'] = ($client->abrangencia == 2 && !empty($client->state->name)) ? $client->state->name : '-';

            $arrayClients[$client->id]['city'] = ($client->abrangencia == 2 && !empty($client->city->name)) ? $client->city->name : '-';

            $dependents = $this->formatBirthsDependentsToArray($client->dependents);

            $arrayClients[$client->id]['dependents'] = ($dependents['num_dependents'] > 0) ? $dependents['num_dependents'] : '-';

            $arrayClients[$client->id]['birth_dependents'] = $dependents['births'];
        }

        return $arrayClients;
    }

    private function formatBirthsDependentsToArray($dependents)
    {
        $numDependents = $dependents->count();

        $birthsDependents['num_dependents'] = $numDependents;

        $birthsDependents['births'] = '-';

        if ($numDependents > 0) {

            $birthsDependents['births'] = '';

            $i = 1;

            foreach ($dependents as $dependent) {

                $birth = new DateTime($dependent->birth);

                $birthsDependents['births'] .= $birth->format('d/m/Y');

                if ($i < $numDependents)
                    $birthsDependents['births'] .= ', ';

                $i++;

            }

        }

        return $birthsDependents;
    }
}
