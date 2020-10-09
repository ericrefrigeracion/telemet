<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Device;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
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
    public function index()
    {

        $users = User::paginate(20);

        return view('users.index')->with(['users' => $users]);

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
        $roles = Role::pluck('name', 'id')->all();
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
                'address' => 'nullable|string',
                'notification_email_1' => 'nullable|email',
                'notification_email_2' => 'nullable|email',
                'notification_email_3' => 'nullable|email',
                'notification_phone_number_1' => 'nullable|string',
                'notification_phone_number_2' => 'nullable|string',
                'notification_phone_number_3' => 'nullable|string',
            ];

            $request->validate($rules);

            $request->password = Hash::make($request->password);

            $user = User::create($request->all());
            $user->roles()->sync($request->get('roles'));

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
        $roles = Role::pluck('name', 'id')->all();
        return view('users.edit', compact('user', 'roles'));
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
                'notification_email_1' => 'nullable|email',
                'notification_email_2' => 'nullable|email',
                'notification_email_3' => 'nullable|email',
                'notification_phone_number_1' => 'nullable|string',
                'notification_phone_number_2' => 'nullable|string',
                'notification_phone_number_3' => 'nullable|string',
            ];

            $request->validate($rules);

            if($request->has('email') && $request->email != $user->email) $user->email_verified_at = null;

            $user->update($request->all());
            $user->roles()->sync($request->get('roles'));

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