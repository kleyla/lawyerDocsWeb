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

Route::get('/', function () {
    return redirect()->route('login');
    // return view('welcome');
});

// Route::get('/admin', function () {
//     return view('admin.dashboard');
// });

Route::get('/exa', function () {
    return view('auth.login2');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/miPerfil', 'UserController@miPerfil')->name('miPerfil');
//USUARIOS
Route::get('/users', 'UserController@index')->name('users');
// Route::post('/userAdd', 'UserController@create');
Route::post('/userAdd', 'UserController@create')->name('userAdd');
Route::get('/userEdit/{idu}', 'UserController@userEdit')->name('userEdit');
Route::get('/userVer/{idu}', 'UserController@userVer')->name('userVer');

Route::post('/userUpdate/{idu}', 'UserController@store')->name('userUpdate');
Route::post('/userDel/{idu}', 'UserController@destroy')->name('userDel');

//CLIENTES PERSONAS
Route::get('/clientes', 'ClienteController@index')->name('clientes');
Route::post('/clienteAdd', 'ClienteController@create')->name('clienteAdd');
Route::get('/clienteEdit/{idu}', 'ClienteController@clienteEdit')->name('clienteEdit');
Route::post('/clienteUpdate/{idu}', 'ClienteController@store')->name('clienteUpdate');
Route::post('/clienteDel/{idu}', 'ClienteController@destroy');
Route::get('/clienteExps/{idc}', 'ClienteController@clienteExps')->name('clienteExps');
Route::get('/clientesAsistente', 'ClienteController@clientesAsistente')->name('clientesAsistente');

//EXPEDIENTE
Route::post('/expedienteAdd/{idc}', 'ExpedienteController@create')->name('expedienteAdd');
Route::post('/expedienteArchivar/{ide}', 'ExpedienteController@destroy')->name('expedienteArchivar');
Route::post('/expedienteEdit/{ide}', 'ExpedienteController@store')->name('expedienteEdit');
Route::post('/userDelExp/{ideu}', 'ExpedienteController@userDelExp');
Route::post('/expUsersAdd/{ide}', 'ExpedienteController@expUsersAdd')->name('expUsersAdd');
//DOCUMENTOS
Route::get('/clienteDocs/{ide}', 'ExpedienteController@clienteDocs')->name('clienteDocs');

// PERMISOS
Route::get('/permisos', 'PermisoController@index')->name('permisos');
Route::post('/permisoAdd', 'PermisoController@store')->name('permisoAdd');
Route::post('/permisoDel/{idp}', 'PermisoController@destroy')->name('permisoDel');

// REPORTES
Route::get('/reportes', 'ReporteController@reportes')->name('reportes');
Route::post('/usuariosRep', 'ReporteController@usuariosRep')->name('usuariosRep');
Route::post('/clientesRep', 'ReporteController@clientesRep')->name('clientesRep');
Route::post('/expRep', 'ReporteController@expRep')->name('expRep');

