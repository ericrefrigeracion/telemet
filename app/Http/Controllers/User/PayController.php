<?php

namespace App\Http\Controllers\User;

use App\Pay;
use App\Price;
use App\Device;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
use App\Http\Controllers\Controller;

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
        if ($pay->users->where('id', Auth::user()->id) || Auth::user()->hasRole('super.admin'))
        {
            return view('pays.show')->with(['pay' => $pay]);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Device $device)
    {
        $user = Auth::user();
        $user_device = $device->user_id;

        if ($device->users->where('id', $user->id) || Auth::user()->hasRole('super.admin'))
        {
            $prices = Price::where('type_device_id', $device->type_device_id)->orderBy('days', 'asc')->get();
            $multiplicator = Price::where('description', 'Multiplicador')->first();

            foreach ($prices as $price)
            {
                $price->amount = $price->price * $multiplicator->price;
                $price->diary = round(($price->price * $multiplicator->price / $price->days), 2);
            }

            return view('pays.create')->with(['device' => $device, 'prices' => $prices]);
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Device $device, Price $price)
    {
        $user = Auth::user();
        $user_device = $device->user_id;

        if ($device->users->where('id', $user->id) || Auth::user()->hasRole('super.admin'))
        {
            $days = $price->days;
            $multiplicator = Price::where('description', 'Multiplicador')->first();

            $title = $price->description . ' para ' . $device->id;
            $description = 'Servicio de monitoreo por ' . $price->days . ' dias para el equipo ' . $device->name . '.';
            $amount = $price->price * $multiplicator->price;

            $item['id'] = $device->id;
            $item['title'] = $title;
            $item['description'] = $description;
            $item['category_id'] = $days;
            $item['quantity'] = 1;
            $item['currency_id'] = 'ARS';
            $item['unit_price'] = $amount;
            $items[0] = $item;

            $payer['name'] = $user->name;
            $payer['surname'] = $user->surname;
            $payer['email'] = $user->email;
            $payer['identification']['type'] = 'DNI';
            $payer['identification']['number'] = $user->dni;
            $payer['phone']['area_code'] = $user->phone_area_code;
            $payer['phone']['number'] = $user->phone_number;
            $payer['address']['street_name'] = $user->address;

            $excluded_payments_type['id'] = $price->excluded;
            $excluded_payments_types[0] = $excluded_payments_type;
            $payment_methods['excluded_payment_types'] = $excluded_payments_types;
            $payment_methods['installments'] = $price->installments;

            $back_urls['success'] = route('pays.success');
            $back_urls['pending'] = route('pays.pending');
            $back_urls['failure'] = route('pays.failure');

            $query_params['access_token'] = config('services.mercadopago.token');
            $headers['Content-Type'] = 'application/json';
            $json['items'] = $items;
            $json['payer'] = $payer;
            $json['payment_methods'] = $payment_methods;
            $json['back_urls'] = $back_urls;
            $json['auto_return'] = 'all';
            $json['notification_url'] = url('/') . '/api/webhooks/'. $user->id . '-' . $device->id . '-' . $price->id;
            $json['external_reference'] = '';

            $client = new Client([ 'base_uri' => config('services.mercadopago.base_uri') ]);

            $response = $client->request( 'POST', 'checkout/preferences', [
                'query' => $query_params,
                'json' => $json,
                'headers' => $headers,
            ] );

            $response = json_decode( $response->getBody()->getContents() );

            return redirect($response->init_point);

            }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        return redirect()->route('pays.index')->with('success', ['El pago se ha realizado con exito, ya esta acreditado en tu cuenta.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        return redirect()->route('pays.index')->with('success', ['El pago se ha realizado con exito, esperamos la acreditacion en tu cuenta.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function failure()
    {
        return redirect()->route('pays.index')->with('warning', ['El pago ha fallado, no se realizo ningun cargo.']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return view('pays.all')->with(['pays' => Pay::paginate(20)]);
    }
}
