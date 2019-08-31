<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function index()
    {
        $slides = DB::table('slides')->where('status', '1')->get();

        return view('site.index', compact('slides'));
    }

    public function aboutUs()
    {
        $conf = DB::table('configurations')->first();

        return view('site.about-us', compact('conf'));
    }

    public function individual()
    {
        $conf = DB::table('configurations')->first();

        return view('site.individual', compact('conf'));
    }

    public function coletivoPorAdesao()
    {
        $conf = DB::table('configurations')->first();

        return view('site.coletivo-por-adesao', compact('conf'));
    }

    public function pme()
    {
        $conf = DB::table('configurations')->first();

        return view('site.pme', compact('conf'));
    }

    public function contactUs()
    {
        $conf = DB::table('configurations')->first();

        return view('site.contact-us', compact('conf'));
    }

    public function contactUsSend(Request $request)
    {
        $data = $request->all();

        Mail::send('mails.contact-us', compact('data'), function($message) use ($data){

            $message->to(env('MAIL_CONTACT_ADDRESS'));
            $message->subject('[CONTATO] Enviado pelo site - ' . $data['name']);

        });

        return redirect('/fale-conosco/recebido');
    }

    public function emailReceived()
    {
        return view('site.contact-us-received');
    }
}
