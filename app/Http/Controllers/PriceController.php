<?php

namespace App\Http\Controllers;

use App\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $prices = Price::paginate(20);

        return view('prices.index', compact('prices'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prices.create');
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
            'days' => 'required|numeric',
            'description' => 'required|string',
            'device_mdl' => 'required|string',
            'price' => 'required|numeric|min:1',
            'excluded' => 'string|nullable',
            'installments' => 'numeric|min:1|max:12',
        ];

        $request->validate($rules);

        $price = Price::create($request->all());

        return view('prices.show', compact('price'))->with('success', ['Price creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {

        return view('prices.show', compact('price'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {

        return view('prices.edit', compact('price'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {

        $rules = [
            'days' => 'required|numeric',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'excluded' => 'string|nullable',
            'installments' => 'numeric|min:1|max:12',
        ];

        $request->validate($rules);

        $price->update($request->all());
        return redirect()->route('prices.show', $price->id)->with('success', ['Price actualizado con exito']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {

        $price->delete();
        return redirect()->route('prices.index')->with('success', ['Price eliminado con exito']);

    }
}
