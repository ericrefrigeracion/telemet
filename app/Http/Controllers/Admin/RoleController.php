<?php

namespace App\Http\Controllers\Admin;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::paginate(10);

        return view('roles.index')->with(['roles' => $roles]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $permissions = Permission::all()->orderBy('slug', 'asc')->get();

        return view('roles.create', compact('permissions'));
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
            //'id' => 'required|integer|exists:receptions|unique:roles',
            //'name' => 'required|max:30',
        ];

        //$request->validate($rules);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index')->with('success', ['Rol creado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devices  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devices  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devices  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

            $rules = [];

            $request->validate($rules);
            $role->update($request->all());

            $role->permissions()->sync($request->get('permissions'));

            return redirect()->route('roles.show', $role->id)->with('success', ['Rol actualizado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Devices  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        $role->delete();
        return redirect()->route('roles.index')->with('success', ['Rol eliminado con exito']);

    }

}