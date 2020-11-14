<?php

namespace App\Http\Controllers\Admin;

use App\Topic;
use App\Display;
use App\DisplayTopic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisplayTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $display_topics = DisplayTopic::orderBy('display_id', 'ASC')->get();

        return view('display-topics.index', compact('display_topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::pluck('slug', 'id')->all();
        $displays = Display::pluck('description', 'id')->all();
        return view('display-topics.create', compact('displays', 'topics'));
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
            'display_id' => 'required|integer|exists:displays,id',
            'topic_id' => 'required|integer|exists:topics,id',
        ];

        $request->validate($rules);

        DisplayTopic::create($request->all());

        return redirect()->route('display-topics.index')->with('success', ['Visualizacion creada con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DisplayTopic  $display_topic
     * @return \Illuminate\Http\Response
     */
    public function show(DisplayTopic $display_topic)
    {
        return view('display-topics.show', compact('display_topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DisplayTopic  $display_topic
     * @return \Illuminate\Http\Response
     */
    public function edit(DisplayTopic $display_topic)
    {
        $topics = Topic::pluck('slug', 'id')->all();
        $displays = Display::pluck('description', 'id')->all();
        return view('display-topics.edit', compact('display_topic', 'displays', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DisplayTopic  $display_topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DisplayTopic $display_topic)
    {
        $rules = [
            'display_id' => 'required|integer|exists:displays,id',
            'topic_id' => 'required|integer|exists:topics,id',
        ];

        $request->validate($rules);

        $display_topic->update($request->all());

        return redirect()->route('display-topics.index')->with('success', ['Visualizacion creada con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DisplayTopic  $display_topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(DisplayTopic $display_topic)
    {
        $display_topic->delete();
        return redirect()->route('display-topics.index')->with('success', ['Visualizacion eliminada con exito']);
    }
}
