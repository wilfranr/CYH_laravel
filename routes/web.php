<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\TerceroController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ruta raiz
Route::get('/', function () {
    return view('home.index');
});

//obtener registro
Route::get('/register', [RegisterController::class, 'show']);//->middleware('guest');
//registrar usuario
Route::post('/register', [RegisterController::class, 'register']);
//obtener login
Route::get('/login', [LoginController::class, 'show']);
//autenticar usuario
Route::post('/login', [LoginController::class, 'login']);

//ruta home
Route::get('/home', [HomeController::class, 'index']);

//cerrar sesion
Route::get('/logout', [LogoutController::class, 'logout']);

//ruta de logo
Route::get('/resize-logo', 'LogoController@resizeLogo');

//ruta de ver pedidos
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

//ruta de crear pedido
Route::get('/pedidos/create', [PedidoController::class, 'create'])->name('pedidos.create');

//ruta para ver terceros
Route::get('/terceros', [TerceroController::class, 'index'])->name('terceros.index');

//ruta para crear terceros
Route::get('/terceros/create', [TerceroController::class, 'create'])->name('terceros.create');

//ruta para almacenar terceros
Route::post('/terceros',[TerceroController::class, 'store'])->name('terceros.store');







