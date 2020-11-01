<?php

namespace App\Http\Controllers\Admin;

use App\TopicControlType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicControlTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topic_control_types = TopicControlType::paginate(10);

        return view('topic-control-types.index')->with(['topic_control_types' => $topic_control_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topic-control-types.create');
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
            'slug' => 'required|string|max:10|unique:topic_control_types,slug',
            'name' => 'required|max:15|unique:topic_control_types,name',
            'description' => 'required|string|max:40',
            'operation' => 'required|string|max:5',
            'min' => 'required|numeric|min:-99|max:999',
            'max' => 'required|numeric|min:-99|max:999',
            'step' => 'required|numeric|min:0|max:1',
            'default' => 'required|numeric|lte:max|gte:min',
        ];

        $request->validate($rules);

        TopicControlType::create($request->all());


        return redirect()->route('topic-control-types.index')->with('success', ['Control creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TopicControlType  $topicControlType
     * @return \Illuminate\Http\Response
     */
    public function show(TopicControlType $topic_control_type)
    {
        return view('topic-control-types.show', compact('topic_control_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TopicControlType  $topicControlType
     * @return \Illuminate\Http\Response
     */
    public function edit(TopicControlType $topic_control_type)
    {
        return view('topic-control-types.edit', compact('topic_control_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TopicControlType  $topicControlType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopicControlType $topic_control_type)
    {
         $rules = [
            'slug' => 'required|string|max:10',
            'name' => 'required|string|max:15',
            'description' => 'required|string|max:40',
            'operation' => 'required|string|max:5',
            'min' => 'required|numeric|min:-99|max:999',
            'max' => 'required|numeric|min:-99|max:999',
            'step' => 'required|numeric|min:0|max:1',
            'default' => 'required|numeric|lte:max|gte:min',
        ];

            $request->validate($rules);
            $topic_control_type->update($request->all());

            return redirect()->route('topic-control-types.show', $topic_control_type->id)->with('success', ['control actualizado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TopicControlType  $topicControlType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopicControlType $topic_control_type)
    {
        $topic_control_type->delete();
        return redirect()->route('topic-control-types.index')->with('success', ['Control eliminado con exito']);
    }
}
