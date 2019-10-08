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
        return view('users.edit-me', compact('user'));

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
                'surname' => 'required|max:25',
                'email' => 'required|email|unique:users,email',
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
            'surname' => 'required|max:25',
            'email' => 'required|email|unique:users,email',
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