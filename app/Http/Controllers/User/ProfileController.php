<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Device;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $user = Auth::user();
        return view('profile.edit', compact('user'));

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

        $user = Auth::user();
        $request->validate($rules);

        if($request->has('email') && $request->email != $user->email)
        {
            $rules = ['email' => 'email|max:255|unique:users,email'];
            $request->validate($rules);
            $user->email_verified_at = null;
            Device::where('notification_email', $user->email)->update(['notification_email' => 'No quiero recibir notificaciones']);
        }


        $user->update($request->all());

        return redirect()->route('profile.show')->with('success', ['Usuario actualizado con exito']);
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
        return redirect()->route('home')->with('success', ['Usuario eliminado con exito']);
    }
}