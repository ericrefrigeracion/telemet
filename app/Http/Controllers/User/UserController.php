<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Device;
use App\Team;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {

        $users = User::paginate(20);

        return view('users.index', compact('users'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = Team::where('admin_id', Auth::user()->id)->paginate(10);

        return view('users.index', compact('users'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
            $rules = [
                'email' => 'email|unique:users,email',
                'password'=> 'required|min:4',
                'name' => 'required|max:25',
                'surname' => 'required|max:25',
                'dni' => 'nullable|numeric',
                'phone_area_code' => 'required|numeric',
                'phone_number' => 'required|numeric',
                'address' => 'nullable|string'
            ];

            $request->validate($rules);

            $request->password = Hash::make($request->password);

            $user = User::create($request->all());
            $user->roles()->attach(3);

            return redirect()->route('users.show', $user->id)->with('success', ['Usuario creado con exito']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $permissions = Permission::where('id', '<', 30)->orderBy('slug', 'asc')->get();
        return view('users.edit', compact('user', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

            $rules = [
                'email' => 'email',
                'name' => 'required|max:25',
                'surname' => 'required|max:25',
                'dni' => 'nullable|numeric',
                'phone_area_code' => 'required|numeric',
                'phone_number' => 'required|numeric',
                'address' => 'nullable|string',
            ];

            $request->validate($rules);

            if($request->has('email') && $request->email != $user->email) $user->email_verified_at = null;

            $user->update($request->all());
            $role->permissions()->sync($request->get('permissions'));

            return redirect()->route('users.show', $user->id)->with('success', ['Usuario actualizado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', ['Usuario eliminado con exito']);
    }
}