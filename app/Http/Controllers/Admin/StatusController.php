<?php

namespace App\Http\Controllers\Admin;

use App\Icon;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::paginate(10);

        return view('statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icons = Icon::pluck('name', 'id')->all();
        return view('statuses.create', compact('icons'));
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
            'icon_id' => 'required|exists:icons,id',
            'name' => 'required|string|max:15|unique:statuses,name',
            'description' => 'string|max:30',
            'scripts' => 'string',
        ];

        $request->validate($rules);

        Status::create($request->all());


        return redirect()->route('statuses.index')->with('success', ['Status creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        return view('statuses.show', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        $icons = Icon::pluck('name', 'id')->all();
        return view('statuses.edit', compact('status', 'icons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $rules = [
            'icon_id' => 'required|exists:icons,id',
            'name' => 'required|string|max:15|unique:statuses,name',
            'description' => 'string|max:30',
            'scripts' => 'string',
        ];

        $request->validate($rules);

        $status->update($request->all());


        return redirect()->route('statuses.index')->with('success', ['Status editado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('statuses.index')->with('success', ['Status eliminado con exito']);
    }
}
