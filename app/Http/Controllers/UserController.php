<?php

namespace App\Http\Controllers;

use App\User;
use App\Device;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::paginate(10);

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
    public function show_me()
    {
        $user = Auth::user();
        return view('users.show-me', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function edit_me()
    {

        $user = Auth::user();
        $roles = Role::all();
        return view('users.edit-me', compact('user', 'roles'));

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
                'name' => 'required|max:25',
                'notification_mail' => 'nullable|email',
                'notification_phone' => 'nullable|numeric',
                'address' => 'nullable|string'
            ];

            $request->validate($rules);
            $user->update($request->all());
            $user->roles()->sync($request->get('roles'));

            return redirect()->route('users.show', $user->id)->with('success', ['Usuario actualizado con exito']);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function update_me(Request $request)
    {

            $rules = [
                'name' => 'required|max:25',
                'notification_mail' => 'nullable|email',
                'notification_phone' => 'nullable|numeric',
                'address' => 'nullable|string'
            ];

            $user = Auth::user();
            $request->validate($rules);
            $user->update($request->all());

            return redirect()->route('users.show-me')->with('success', ['Usuario actualizado con exito']);
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