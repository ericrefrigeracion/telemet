<?php

namespace App\Http\Controllers\Admin;

use App\Icon;
use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::paginate(10);

        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icons = Icon::where('type', 'topic')->pluck('name', 'id')->all();
        return view('topics.create', compact('icons'));
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
            'slug' => 'required|string|max:20',
            'unit' => 'required|string|max:10',
            'name' => 'required|string|max:20',
            'decimals' => 'required|integer|min:0|max:3',
            'icon_id' => 'required|integer|exists:icons,id',
            'color' => 'required|string|max:25',
            'filled' => 'boolean',
        ];

        $request->validate($rules);

        Topic::create($request->all());


        return redirect()->route('topics.index')->with('success', ['Topico creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $icons = Icon::where('type', 'topic')->pluck('name', 'id')->all();
        return view('topics.edit', compact('topic', 'icons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $rules = [
            'icon_id' => 'required|integer|exists:icons,id',
            'slug' => 'required|string|max:7',
            'unit' => 'required|string|max:10',
            'name' => 'required|string|max:15',
            'decimals' => 'required|integer|min:0|max:3',
            'color' => 'required|string',
            'filled' => 'required|boolean',

        ];

        $request->validate($rules);

        $topic->update($request->all());


        return redirect()->route('topics.index')->with('success', ['Topico editado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topics.index')->with('success', ['Topico eliminado con exito']);
    }
}
