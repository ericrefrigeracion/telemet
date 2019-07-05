<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $payments = Auth::user()->devices()->payments()->paginate(10);

        return view('payments.index')->with(['payments' => $payments]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'device_id' => 'exists',
        ];

        $request->validate($rules);

        $payment = new Payment;
        $payment->device_id = $request->device_id;

        $device->name = $request->name;
        $device->user_id = Auth::user()->id;
        $device->view_alerts_at = now();
        $device->send_mails = 0;
        $device->admin_mon = 0;

        $device->save();

        return redirect()->route('devices.show', $request->id)->with('info', 'Dispositivo creado con exito');
    }
}
