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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function (Request $request) {
    return response()->json(\App\User::all());
})->middleware('auth:api');

//Route::get('/users', function (Request $request) {
//    return response()->json(\App\User::all());
//})->middleware('auth.basic');

Route::get('/tokenlist', 'HomeController@tokenlist')->middleware('auth.basic');

Route::get('/movimentos', 'HomeController@movimentos')->middleware('auth:api');

Route::group(['namespace' => 'api'], function () {
    Route::post('/login', 'UserController@login');
});

Route::post('/produtos', 'ProdutoController@store');
Route::get('/produtos', 'ProdutoController@index')->middleware('auth:api');
Route::get('/produtos/{produto}', 'ProdutoController@show')->middleware('auth:api');
Route::put('/produtos/{produto}', 'ProdutoController@update')->middleware('auth:api');
Route::delete('/produtos/{produto}', 'ProdutoController@destroy')->middleware('auth:api');

Route::get('/cidades', 'CidadeController@index');
Route::get('/estados', 'EstadoController@index')->middleware('auth:api');

Route::get('/acondicionamentos', 'AcondController@index');
Route::post('/acondicionamentos', 'AcondController@store')->middleware('auth:api');
Route::get('/acondicionamentos/{acondicionamento}', 'AcondController@show')->middleware('auth:api');
Route::put('/acondicionamentos/{acondicionamento}', 'AcondController@update')->middleware('auth:api');
Route::delete('/acondicionamentos/{acondicionamento}', 'AcondController@destroy')->middleware('auth:api');        

Route::get('/classeresiduos', 'ClasseResiduoController@index')->middleware('auth:api');
Route::get('/listclasseresiduos', 'ClasseResiduoController@listClasseResiduo')->middleware('auth:api');
Route::post('/classeresiduos', 'ClasseResiduoController@store')->middleware('auth:api');
Route::get('/classeresiduos/{classeresiduo}', 'ClasseResiduoController@show')->middleware('auth:api');
Route::put('/classeresiduos/{classeresiduo}', 'ClasseResiduoController@update')->middleware('auth:api');
Route::delete('/classeresiduos/{classeresiduo}', 'ClasseResiduoController@destroy')->middleware('auth:api');

Route::get('/tipoatividades', 'TipoAtividadeController@index');
Route::post('/tipoatividades', 'TipoAtividadeController@store')->middleware('auth:api');
Route::get('/tipoatividades/{tipoatividade}', 'TipoAtividadeController@show')->middleware('auth:api');
Route::put('/tipoatividades/{tipoatividade}', 'TipoAtividadeController@update')->middleware('auth:api');
Route::delete('/tipoatividades/{tipoatividade}', 'TipoAtividadeController@destroy')->middleware('auth:api');

Route::get('/residuos', 'ResiduoController@index');
Route::post('/residuos', 'ResiduoController@store')->middleware('auth:api');
Route::get('/residuos/{residuo}', 'ResiduoController@show');
Route::put('/residuos/{residuo}', 'ResiduoController@update')->middleware('auth:api');
Route::delete('/residuos/{residuo}', 'ResiduoController@destroy')->middleware('auth:api');

Route::get('/tipotratamentos', 'TipoTratamentoController@index');
Route::post('/tipotratamentos', 'TipoTratamentoController@store')->middleware('auth:api');
Route::get('/tipotratamentos/{tipotratamento}', 'TipoTratamentoController@show')->middleware('auth:api');
Route::put('/tipotratamentos/{tipotratamento}', 'TipoTratamentoController@update')->middleware('auth:api');
Route::delete('/tipotratamentos/{tipotratamento}', 'TipoTratamentoController@destroy')->middleware('auth:api');

Route::get('/clientes', 'ClienteController@index');
Route::post('/clientes', 'ClienteController@store')->middleware('auth:api');
Route::get('/clientes/{cliente}', 'ClienteController@show')->middleware('auth:api');
Route::put('/clientes/{cliente}', 'ClienteController@update')->middleware('auth:api');
Route::delete('/clientes/{cliente}', 'ClienteController@destroy')->middleware('auth:api');


