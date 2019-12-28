<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login','UserController@loginApi');

Route::get('clientes', 'ClienteController@clientesApi');
Route::get('cliente/{idc}', 'ClienteController@clienteApi');
Route::get('clienteExpedientes/{idc}', 'ExpedienteController@clienteExpedientes');
Route::get('expedienteDocumentos/{ide}', 'ExpedienteController@expedienteDocumentos');
Route::post('newDoc/{ide}/{idu}', 'DocumentoController@newDoc');
Route::get('clientesUserApi/{idu}', 'ClienteController@clientesUserApi');
