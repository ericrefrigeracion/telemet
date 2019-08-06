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
        $multiplicator = Price::where('description', 'Multiplicador')->first();

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
        $device = Device::find($request->device_id);
        $days = $request->days;

        if($device->monitor_expires_at > now())
        {
            $monitorig_expires = $device->monitor_expires_at;
        }else{
            $monitorig_expires = now();
        }

        $monitorig_expires->addDays($days);
        $multiplicator = Price::where('description', 'Multiplicador')->first();
        $price = Price::where('days', $days)->first();
        $installments = $price->installments;
        $excluded_payments_type['id'] = $price->excluded;
        $amount = $price->price * $multiplicator->price;
        $description = 'Servicio de monitoreo para el equipo ' . $device->id . ' hasta el dia ' . $monitorig_expires;

        $item['id'] = $device->id;
        $item['title'] = $monitorig_expires;
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

        $back_urls['success'] = 'https://sysnet.com.ar/pays/success';
        $back_urls['pending'] = 'https://sysnet.com.ar/pays/pending';
        $back_urls['failure'] = 'https://sysnet.com.ar/pays/failure';

        $query_params['access_token'] = config('services.mercadopago.token');
        $headers['Content-Type'] = 'application/json';
        $json['items'] = $items;
        $json['payer'] = $payer;
        $json['payment_methods'] = $payment_methods;
        $json['back_urls'] = $back_urls;
        $json['auto_return'] = 'all';
        $json['notification_url'] = 'https://sysnet.com.ar/api/webhooks';
        $json['external_reference'] = '';

        $client = new Client([ 'base_uri' => config('services.mercadopago.base_uri') ]);

        $response = $client->request( 'POST', 'checkout/preferences', [
            'query' => $query_params,
            'json' => $json,
            'headers' => $headers,
        ] );

        $response = json_decode( $response->getBody()->getContents() );

        $pay = new Pay;

        $pay->device_id = $device->id;
        $pay->user_id = Auth::user()->id;
        $pay->preference_id = $response->id;
        $pay->valid_at = $monitorig_expires;
        $pay->collection_status = 'Created - no se genereron cargos/el pago fue abandonado';
        $pay->init_point = $response->init_point;

        $pay->save();


        return redirect($response->init_point);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $pay = Pay::where('preference_id', $request->preference_id)->first();

        $pay->update($request->all());

        return view('pays.show')->with(['pay' => $pay])->with('success', ['El pago se ha realizado con exito, apenas se acredite comenzara el monitoreo']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending(Request $request)
    {

        $pay = Pay::where('preference_id', $request->preference_id)->first();

        $pay->update($request->all());

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

        $pay = Pay::where('preference_id', $request->preference_id)->first();

        $pay->update($request->all());

        $pays = Auth::user()->pays()->latest()->paginate(20);

        return view('pays.create')->with('errors', ['El pago ha fallado, no se hizo ningun cobro. Por favor intente nuevamente.']);
    }
}
