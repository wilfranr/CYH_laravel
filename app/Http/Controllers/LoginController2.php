<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;


// class LoginController extends Controller
// {
//     // Vista de login
//     public function show()
//     {
//         if (auth()->check()) {
//             return redirect()->route('/home');
//         }
//         return view('auth.login');
//     }

//     // Autenticar usuario
//     public function login(LoginRequest $request)
//     {
//         // Validar credenciales
//         if (auth()->attempt($request->validated())) {
//             $request->session()->regenerate();
//             // Redireccionar
//             return redirect()->intended('/home');
//         }
//         // Redireccionar
//         return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput(request(['email']));
//     }

// }
