<?php

namespace App\Http\Controllers;

use App\Pay;
use App\Price;
use App\Device;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class PayController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pays = Auth::user()->pays()->latest()->paginate(20);

        return view('pays.index')->with(['pays' => $pays]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function show(Pay $pay)
    {
        return view('pays.show')->with(['pay' => $pay]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $devices = Auth::user()->devices()->get();
        $prices = Price::all();
        $multiplicator = Price::where('days', 0)->first();

        foreach ($prices as $price) {
            if ($price->days != 0) {
                $price->amount = $price->price * $multiplicator->price;
                $price->diary = ($price->price * $multiplicator->price) / $price->days;
            }
        }

        return view('pays.create')->with(['devices' => $devices, 'prices' => $prices]);
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
            'device_id' => 'required|exists:devices,id',
            'days' => 'required|exists:prices,days',
        ];

        $request->validate($rules);

        $user = Auth::user();
        $device_id = $request->device_id;
        $days = $request->days;

        if($user->pays()->where('device_id', $device_id)->where('status', 'approved')->count() > 0)
        {
            $monitorig_expires = $user->pays()->where('device_id', $device_id)->where('status', 'approved')->latest()->first()->external_reference;
        }else{
            $monitorig_expires = now();
        }

        $monitorig_expires->addDays($days);
        $multiplicator = Price::where('days', 0)->first();
        $price = Price::where('days', $days)->first();
        $installments = $price->installments;
        $excluded_payments_type['id'] = $price->excluded;
        $amount = $price->price * $multiplicator->price;

        $title = $price->description;
        $description = 'Servicio de monitoreo para el equipo ' . $device_id . ' hasta el dia ' . $monitorig_expires;

        $client = new Client([ 'base_uri' => config('services.mercadopago.base_uri') ]);

        $query_params['access_token'] = config('services.mercadopago.token');

        $item['id'] = $device_id;
        $item['title'] = $title;
        $item['description'] = $description;
        $item['quantity'] = 1;
        $item['currency_id'] = 'ARS';
        $item['unit_price'] = $amount;
        $items[0] = $item;

        $payer['name'] = $user->name;
        $payer['email'] = $user->email;
        $payer['identification']['type'] = 'DNI';
        $payer['identification']['number'] = $user->dni;
        $payer['phone']['number'] = $user->notification_phone;

        $excluded_payments_types[0] = $excluded_payments_type;
        $payment_methods['excluded_payment_types'] = $excluded_payments_types;
        $payment_methods['installments'] = $installments;

        $back_urls['success'] = 'sysnet.com.ar/pays/success';
        $back_urls['pending'] = 'sysnet.com.ar/pays/pending';
        $back_urls['failure'] = 'sysnet.com.ar/pays/failure';

        $json['items'] = $items;
        $json['payer'] = $payer;
        $json['payment_methods'] = $payment_methods;
        $json['back_urls'] = $back_urls;
        $json['auto_return'] = 'all';
        $json['notification_url'] = 'sysnet.com.ar/api/webhooks';
        $json['external_reference'] = $monitorig_expires;

        $headers['Content-Type'] = 'application/json';

        $response = $client->request( 'POST', 'checkout/preferences', [
            'query' => $query_params,
            'json' => $json,
            'headers' => $headers,
        ] );

        $response = json_decode( $response->getBody()->getContents() );

        $pay = new Pay;
        $pay->user_id = $user->id;
        $pay->device_id = $device_id;
        $pay->webhook_identifier = $response->id;
        $pay->amount = $amount;
        $pay->status = 'created';
        $pay->title = $title;
        $pay->description = $description;
        $pay->external_reference = $monitorig_expires;
        $pay->init_point = $response->init_point;
        $pay->save();

        return view('pays.conversion')->with(['pay' => $pay])->with('success', ['Pago generado con exito, solo resta elegir el metodo de pago que prefieras']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $user = Auth::user();
        $device_id = $request->id;

        $pay = Pay::where('user_id', $user->id)->where('device_id', $device_id)->where('status', 'created')->latest()->first();
        $pay->webhook_id = $request->collection_id;
        $pay->status = $request->collection_status;
        $pay->type = $request->payment_type;
        $pay->update();

        return view('pays.show')->with(['pay' => $pay])->with('success', ['El pago se ha realizado con exito, apenas se acredite comenzara el monitoreo']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending(Request $request)
    {
        $user = Auth::user();
        $device_id = $request->id;

        $pay = Pay::where('user_id', $user->id)->where('device_id', $device_id)->where('status', 'created')->latest()->first();
        $pay->webhook_id = $request->collection_id;
        $pay->status = $request->collection_status;
        $pay->type = $request->payment_type;
        $pay->update();

        $pays = Auth::user()->pays()->latest()->paginate(20);
        return view('pays.index')->with('success', ['El pago se ha realizado con exito, apenas se acredite comenzara el monitoreo']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function failure(Request $request)
    {
        $user = Auth::user();
        $device_id = $request->id;

        $pay = Pay::where('user_id', $user->id)->where('device_id', $device_id)->where('status', 'created')->latest()->first();
        $pay->webhook_id = $request->collection_id;
        $pay->status = $request->collection_status;
        $pay->type = $request->payment_type;
        $pay->update();

        $pays = Auth::user()->pays()->latest()->paginate(20);
        return view('pays.create')->with('errors', ['El pago ha fallado, no se hizo ningun cobro. Por favor intente nuevamente.']);
    }
}
