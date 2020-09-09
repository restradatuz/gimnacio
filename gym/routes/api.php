<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@newUser');
Route::post('nuevo-viaje', 'API\ViajesController@nuevoViaje');
Route::post('buscar-viajes', 'API\ViajesController@buscarViaje');
Route::post('aceptar-viaje', 'API\ViajesController@aceptarViaje');
Route::post('cancelar-viaje', 'API\ViajesController@cancelarViaje');
Route::get('viajes/get-origin', 'API\ViajesController@reverseLocation');
Route::get('viajes/get-places', 'API\ViajesController@getAddress');
Route::get('viajes/reverse-geolocation', 'API\ViajesController@getPlaceLocation');
Route::get('viajes/get-route', 'API\ViajesController@getRoute');
Route::post('viajes/solicitar-viaje', 'API\ViajesController@nuevoViaje');
Route::post('viajes/cancelar-viaje-user', 'API\ViajesController@usuarioCancelaViaje');


Route::post('usuarios/nuevo-usuario', 'API\UserController@newUser');
Route::post('usuarios/approved-user', 'API\UserController@isApprovedUser');
Route::get('user', 'API\UserController@getUser');
Route::post('user/set-online', 'API\UserController@setUserOnline');

//  Rutas de Conekta
Route::post('conekta/cliente', 'API\ConektaController@clienteConekta');
Route::post('conekta/nuevo-cliente', 'API\ConektaController@nuevoCliente');
Route::get('conekta/asignar-tarjeta', 'API\ConektaController@asignarTarjeta');
Route::get('conekta/procesar-orden', 'API\ConektaController@crearORden');



//rutas nuevas generadas
Route::get('calendario/obtenercalendario/{id_sucursal}/{id_usuario}', 'API\Calendario@obtenercalendario');
Route::get('horarios/{id_horario}/{fecha}/{id_cliente}/{id_sucursal}', 'API\Calendario@obtenerhorario');

Route::post('insertar_reservacion', 'API\Calendario@insertar_reservacion');

Route::post('obtenerreservaciones', 'API\UserController@obtener_reservaciones_cliente');

Route::get('obtener_ubicacion', 'API\UserController@obtener_ubicacion');
Route::get('obtener_imagenes/{id_sucursal}', 'API\UserController@obtener_imagesapp');

Route::post('cancelarreservaciones', 'API\UserController@cancelarreservaciones');