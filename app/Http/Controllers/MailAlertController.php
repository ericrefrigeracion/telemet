<?php

namespace App\Http\Controllers;

use App\MailAlert;
use Illuminate\Http\Request;

class MailAlertController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mail_alerts = MailAlert::paginate(50);

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
