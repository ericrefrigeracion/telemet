<?php

namespace App\Http\Controllers\Admin;

use App\MailAlert;
use Illuminate\Http\Request;
use App\Http\controllers\Controller;

class MailAlertController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mail_alerts = MailAlert::where('created_at', '!=', null)->latest()->paginate(50);


        return view('mail-alerts.index')->with(['mail_alerts' => $mail_alerts]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MailAlert  $mailAlert
     * @return \Illuminate\Http\Response
     */
    public function show(MailAlert $mail_alert)
    {
        return view('mail-alerts.show')->with(['mail_alert' => $mail_alert]);
    }

}
