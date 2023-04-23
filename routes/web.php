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
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\UserController;





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

//ruta para ver tercero creado
Route::get('/terceros/{id}', [TerceroController::class, 'show'])->name('terceros.show');

//ciudades
Route::get('/ciudades/{codigo_pais}', [CiudadController::class, 'getCiudadesByPais']);

//ruta para descargar certificacion
Route::get('terceros/{id}/certificacion', [TerceroController::class, 'downloadCertificacion'])->name('terceros.downloadCertificacion');

//rutas maquinas
Route::get('maquinas/create', 'MaquinaController@create')->name('maquinas.create');
Route::post('maquinas', 'MaquinaController@store')->name('maquinas.store');
Route::get('maquinas', 'MaquinaController@index')->name('maquinas.index');
Route::get('/terceros/{id}/maquinas', [TerceroController::class, 'getMaquinasByTercero'])->name('terceros.maquinas');

//ruta listas
Route::get('/listas', [ListaController::class, 'index'])->name('listas.index');
Route::get('/listas/create', [ListaController::class, 'create'])->name('listas.create');
Route::post('/listas', [ListaController::class, 'store'])->name('listas.store');
Route::get('/listas/{id}', [ListaController::class, 'show'])->name('listas.show');
Route::get('/listas/{id}/edit', [ListaController::class, 'edit'])->name('listas.edit');
Route::put('/listas/{id}/update', [ListaController::class, 'update'])->name('listas.update');
Route::delete('/listas/{id}', [ListaController::class, 'destroy'])->name('listas.destroy');

//rutas pedidos
Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
Route::get('/pedidos/{id}/edit', [PedidoController::class, 'edit'])->name('pedidos.edit');
Route::put('/pedidos/{id}/update', [PedidoController::class, 'update'])->name('pedidos.update');
Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');


//rutas usuarios
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//Crear contacto
// Route::post('/terceros/crearConContactos', 'TerceroController@crearConContactos')->name('terceros.crearConContactos');















