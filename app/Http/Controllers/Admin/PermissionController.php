<?php

namespace App\Http\Controllers\Admin;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::where('id', '>', 0)->orderBy('slug', 'asc')->get();
        return view('permissions.index')->with(['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'id' => 'unique:permissions,id',
            'name' => 'required|max:25',
            'slug' => 'required|max:25',
            'description' => 'required|max:60',
            'icon_id' => 'required|exists:icons,id'
        ];

        $request->validate($rules);

        Permission::create($request->all());

        return redirect()->route('permissions.index')->with('success', ['Permiso creado con exito']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $rules = [
            'name' => 'required|max:25',
            'slug' => 'required|max:25',
            'description' => 'required|max:60',
            'icon_id' => 'required|exists:icons,id'
        ];

        $request->validate($rules);
        $permission->update($request->all());

        return redirect()->route('permissions.index')->with('success', ['Permiso actualizado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', ['Permiso eliminado con exito']);
    }
}
