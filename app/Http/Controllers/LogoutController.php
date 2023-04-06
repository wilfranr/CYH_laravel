<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    //cerrar sesion
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');     

    }

}
