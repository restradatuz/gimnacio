<?php
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
Route::get('/', 'SigninController@index')->name('login');
Route::post('/login/auth', 'SigninController@authenticate')->name('authenti');
Route::get('logout', function(){
    Auth::logout();
    return redirect()->route('login');
})->name('logout');



Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');
Route::get('/usuarios', 'UsuariosController@index')->name('usuarios')->middleware('auth');
Route::get('usuario/{id}', 'UsuariosController@ver_usuario')->name('verusuario')->middleware('auth');
Route::get('nuevousuario', 'UsuariosController@nuevo_usuario')->name('nuevousuario')->middleware('auth');
Route::post('/subir_archivos/{id}', 'UsuariosController@subir_archivos')->middleware('auth');
Route::post('/usuarios/nuevo-usuario/agregar', 'UsuariosController@agregar_usuario')->middleware('Auth');
Route::post('actualizar_usuario', 'UsuariosController@actualizar_usuario')->name('actualizar_usuario')->middleware('auth');
Route::get('reglas', 'ReglasController@index')->name('reglas')->middleware('auth');
Route::post('reglas/actualizar', 'ReglasController@actualizarReglas')->name('actualizarreglas')->middleware('auth');



Route::get('horarios', 'Horarios@index')->name('horarios')->middleware('auth');
Route::get('horarios-crear', 'Horarios@crear_horario')->middleware('auth');
Route::post('horarios-guardar', 'Horarios@horario_guardar')->name('horarioguardar')->middleware('auth');
//nuevos metodos
Route::get('clientes', 'UsuariosController@clientes')->name('clientes')->middleware('auth');
Route::get('cliente/{id}', 'UsuariosController@ver_cliente')->name('vercliente')->middleware('auth');
Route::get('dias-semana', 'DiasSemana@index')->name('diassemana')->middleware('auth');
Route::post('actualizasemana', 'DiasSemana@actualizardias')->name('actualizasemana')->middleware('auth');
Route::post('agregar-usuario', 'UsuariosController@agregarusuario2')->name('agregarusuario2')->middleware('auth');
Route::get('crearzona','UbicacionController@create')->name('crearzona')->middleware('auth');
Route::post('zonas/updatestore','UbicacionController@updatestore')->name('updatestore')->middleware('auth');
Route::get('uploadimagesapp','UsuariosController@uploadimagesapp')->name('uploadimagesapp')->middleware('auth');
Route::post('subir_archivosApp', 'UsuariosController@subir_archivosapp')->name('subir_archivosApp')->middleware('auth');
Route::get('eliminar/{id}', 'UsuariosController@cambiarestatus_imagen')->middleware('auth');
Route::get('eliminarusuario/{id}', 'UsuariosController@eliminarUsuario')->middleware('auth');
Route::get('eliminarcliente/{id}', 'UsuariosController@eliminarcliente')->middleware('auth');


Route::get('reservaciones', 'UsuariosController@reservaciones')->name('reservaciones')->middleware('auth');
Route::post('buscarreservaciones', 'UsuariosController@buscarreservaciones')->name('buscarreservaciones')->middleware('auth');

Route::get('editarhorario/{id}/{dia}', 'DiasSemana@editarhorario')->name('editarhorario')->middleware('auth');
Route::post('guardarhorarioelegir', 'DiasSemana@guardarhorarioelegir')->name('guardarhorarioelegir')->middleware('auth');
Route::get('ver_horario/{id}/{nombre}', 'DiasSemana@ver_horario')->name('ver_horario')->middleware('auth');




Route::get('actualizarhorario/{id}/{horario}/{consecutivo}', 'DiasSemana@actualizarhorario')->name('actualizarhorario')->middleware('auth');
Route::get('eliminarhorario/{id}', 'DiasSemana@eliminarhorario')->name('eliminarhorario')->middleware('auth');


Route::get('sucursales', 'Sucursal@index')->name('sucursales')->middleware('auth');
Route::get('crear-sucursal', 'Sucursal@crear_sucursal')->name('crear-sucursal')->middleware('auth');
Route::post('nuevasucursal', 'Sucursal@nueva')->name('nuevasucursal')->middleware('auth');


//altas admin
Route::get('nuevousuarioadmn', 'UsuariosController@nuevo_usuarioadm')->name('nuevousuarioadmn')->middleware('auth');
Route::post('agregar-usuarioadmin', 'UsuariosController@agregarusuarioadm')->name('agregarusuarioadm')->middleware('auth');

Route::get('usuarios-gerente', 'UsuariosController@usuariosgerente')->name('usuarios-gerente')->middleware('auth');
Route::get('clientesgerente', 'UsuariosController@clientesgerente')->name('clientesgerente')->middleware('auth');


Route::get('clientesSC', 'UsuariosController@clientesSC')->name('clientesSC')->middleware('auth');
Route::get('editarclienteSc/{id}', 'UsuariosController@editarclienteSc')->name('editarclienteSc')->middleware('auth');
Route::post('actualizar_usuarioSC', 'UsuariosController@actualizar_usuarioSC')->name('actualizar_usuarioSC')->middleware('auth');
//Route::get('cliente/{id}', 'UsuariosController@ver_cliente')->name('vercliente')->middleware('auth');