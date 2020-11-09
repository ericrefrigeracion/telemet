<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ImpersonateController extends Controller
{
    public function start(User $user)
    {
    	session()->put('impersonated_by', auth()->user()->id);

    	Auth::login($user);

    	return redirect('centinela/devices');
    }

    public function stop()
    {

    	Auth::loginUsingId(session()->pull('impersonated_by'));

    	return redirect('admins/users/all');
    }
}
