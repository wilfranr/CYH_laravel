<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;



class RegisterController extends Controller
{
    //Vista de register
    public function show()
    {
        return view('auth.register');
    }

    //registrar usuario
    public function register(RegisterRequest $request)
    {
        //crear usuario
        $user = User::create($request->validated());
        //autenticar usuario
        auth()->login($user);
        //redireccionar
        return redirect()->route('/login')->with('success', 'Usuario registrado correctamente');        
    }
}
