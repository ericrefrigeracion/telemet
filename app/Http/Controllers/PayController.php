<?php

namespace App\Http\Controllers;

use App\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('pays.create');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pay = Pay::create($request->all());

        return $pay;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        return view('pays.asign')->with('info', 'El pago se ha realizado con exito, apenas se acredite comenzara el monitoreo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function process()
    {
        return view('pays.asign')->with('info', 'El pago se ha realizado con exito, apenas se acredite comenzara el monitoreo');
    }
}
