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

        $users = User::all();

        return view('users.all', compact('users'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $team = Team::where('admin_id', Auth::user()->id)->get();

        foreach ($team as $user) {
            $user->user = User::find($user->user_id);
        }
        dd($team);

        return view('users.index', compact('team'));

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
                'password'=> 'required|min:8',
                'name' => 'required|max:25',
                'surname' => 'required|max:25',
                'dni' => 'nullable|numeric',
                'phone_area_code' => 'required|numeric',
                'phone_number' => 'required|numeric',
                'address' => 'nullable|string'
            ];

            $request->validate($rules);

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->name,
                'surname' => $request->surname,
                'dni' => $request->dni,
                'phone_area_code' => $request->phone_area_code,
                'phone_number' => $request->phone_number,
                'address' => $request->address
            ]);
            Team::create([
                'admin_id' => Auth::user()->id,
                'user_id' => $user->id
            ]);
            $user->roles()->attach(1);

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
        $permissions = Permission::where('id', '<=', 30)->orderBy('slug', 'asc')->get();
        $devices = Auth::user()->devices;
        return view('users.edit', compact('user', 'permissions', 'devices'));
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
            $user->permissions()->sync($request->get('permissions'));
            $user->devices()->sync($request->get('devices'));

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