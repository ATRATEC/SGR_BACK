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

Route::post('/produtos', 'ProdutoController@store')->middleware('auth:api');
Route::get('/produtos', 'ProdutoController@index')->middleware('auth:api');
Route::get('/produtos/{produto}', 'ProdutoController@show')->middleware('auth:api');
Route::put('/produtos/{produto}', 'ProdutoController@update')->middleware('auth:api');
Route::delete('/produtos/{produto}', 'ProdutoController@destroy')->middleware('auth:api');

Route::get('/cidades', 'CidadeController@index')->middleware('auth:api');
Route::get('/estados', 'EstadoController@index')->middleware('auth:api');

Route::get('/acondicionamentos', 'AcondController@index')->middleware('auth:api');
Route::get('/listacondicionamentos', 'AcondController@listAcondicionamento')->middleware('auth:api');
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

Route::get('/tipoatividades', 'TipoAtividadeController@index')->middleware('auth:api');
Route::post('/tipoatividades', 'TipoAtividadeController@store')->middleware('auth:api');
Route::get('/listtipoatividades', 'TipoAtividadeController@listTipoAtividade')->middleware('auth:api');
Route::get('/tipoatividades/{tipoatividade}', 'TipoAtividadeController@show')->middleware('auth:api');
Route::put('/tipoatividades/{tipoatividade}', 'TipoAtividadeController@update')->middleware('auth:api');
Route::delete('/tipoatividades/{tipoatividade}', 'TipoAtividadeController@destroy')->middleware('auth:api');

Route::get('/residuos', 'ResiduoController@index')->middleware('auth:api');
Route::post('/residuos', 'ResiduoController@store')->middleware('auth:api');
Route::get('/listresiduos', 'ResiduoController@listResiduo')->middleware('auth:api');
Route::get('/residuos/{residuo}', 'ResiduoController@show')->middleware('auth:api');
Route::put('/residuos/{residuo}', 'ResiduoController@update')->middleware('auth:api');
Route::delete('/residuos/{residuo}', 'ResiduoController@destroy')->middleware('auth:api');

Route::get('/tipotratamentos', 'TipoTratamentoController@index')->middleware('auth:api');
Route::post('/tipotratamentos', 'TipoTratamentoController@store')->middleware('auth:api');
Route::get('/listtipotratamentos', 'TipoTratamentoController@listTipoTratamento');
Route::get('/tipotratamentos/{tipotratamento}', 'TipoTratamentoController@show')->middleware('auth:api');
Route::put('/tipotratamentos/{tipotratamento}', 'TipoTratamentoController@update')->middleware('auth:api');
Route::delete('/tipotratamentos/{tipotratamento}', 'TipoTratamentoController@destroy')->middleware('auth:api');

Route::get('/clientes', 'ClienteController@index')->middleware('auth:api');
Route::post('/clientes', 'ClienteController@store')->middleware('auth:api');
Route::get('/clientes/{cliente}', 'ClienteController@show')->middleware('auth:api');
Route::put('/clientes/{cliente}', 'ClienteController@update')->middleware('auth:api');
Route::delete('/clientes/{cliente}', 'ClienteController@destroy')->middleware('auth:api');

Route::get('/fornecedores', 'FornecedorController@index')->middleware('auth:api');
Route::post('/fornecedores', 'FornecedorController@store')->middleware('auth:api');
Route::get('/fornecedores/{fornecedor}', 'FornecedorController@show')->middleware('auth:api');
Route::put('/fornecedores/{fornecedor}', 'FornecedorController@update')->middleware('auth:api');
Route::delete('/fornecedores/{fornecedor}', 'FornecedorController@destroy')->middleware('auth:api');

Route::get('/tipodocumentos', 'TipoDocumentoController@index')->middleware('auth:api');
Route::post('/tipodocumentos', 'TipoDocumentoController@store')->middleware('auth:api');
Route::get('/listtipodocumentos', 'TipoDocumentoController@listTipoDocumento')->middleware('auth:api');
Route::get('/tipodocumentos/{tipodocumento}', 'TipoDocumentoController@show')->middleware('auth:api');
Route::put('/tipodocumentos/{tipodocumento}', 'TipoDocumentoController@update')->middleware('auth:api');
Route::delete('/tipodocumentos/{tipodocumento}', 'TipoDocumentoController@destroy')->middleware('auth:api');

Route::get('/documentos/clientes', 'DocumentoController@indexCliente')->middleware('auth:api');
Route::get('/documentos/fornecedores', 'DocumentoController@indexFornecedor')->middleware('auth:api');
Route::post('/documentos/clientes', 'DocumentoController@storeCliente')->middleware('auth:api');
Route::post('/documentos/fornecedores', 'DocumentoController@storeFornecedor')->middleware('auth:api');
Route::post('/documentos/uploadcli', 'DocumentoController@uploadCliente')->middleware('auth:api');
Route::post('/documentos/uploadfor', 'DocumentoController@uploadFornecedor')->middleware('auth:api');
Route::get('/documentos/clientes/{documento}', 'DocumentoController@showCliente')->middleware('auth:api');
Route::get('/documentos/fornecedores/{documento}', 'DocumentoController@showFornecedor')->middleware('auth:api');
Route::put('/documentos/clientes/{documento}', 'DocumentoController@updateCliente')->middleware('auth:api');
Route::put('/documentos/fornecedores/{documento}', 'DocumentoController@updateFornecedor')->middleware('auth:api');
Route::delete('/documentos/clientes/{documento}', 'DocumentoController@destroyCliente')->middleware('auth:api');
Route::delete('/documentos/fornecedores/{documento}', 'DocumentoController@destroyFornecedor')->middleware('auth:api');

Route::get('/documentos/downloadanexo', 'DocumentoController@downloadAnexo');


Route::get('/unidades', 'UnidadeController@index')->middleware('auth:api');
Route::post('/unidades', 'UnidadeController@store')->middleware('auth:api');
Route::get('/listunidades', 'UnidadeController@listUnidade')->middleware('auth:api');
Route::get('/unidades/{unidade}', 'UnidadeController@show')->middleware('auth:api');
Route::put('/unidades/{unidade}', 'UnidadeController@update')->middleware('auth:api');
Route::delete('/unidades/{unidade}', 'UnidadeController@destroy')->middleware('auth:api');

Route::get('/servicos', 'ServicoController@index')->middleware('auth:api');
Route::post('/servicos', 'ServicoController@store')->middleware('auth:api');
Route::get('/listservicos', 'ServicoController@listServico')->middleware('auth:api');
Route::get('/servicos/{servico}', 'ServicoController@show')->middleware('auth:api');
Route::put('/servicos/{servico}', 'ServicoController@update')->middleware('auth:api');
Route::delete('/servicos/{servico}', 'ServicoController@destroy')->middleware('auth:api');

Route::get('/contratofornecedores', 'ContratoFornecedorController@index')->middleware('auth:api');
Route::post('/contratofornecedores', 'ContratoFornecedorController@store')->middleware('auth:api');
Route::get('/listcontratofornecedores', 'ContratoFornecedorController@listContratoFornecedor')->middleware('auth:api');
Route::get('/contratofornecedores/{contratofornecedor}', 'ContratoFornecedorController@show')->middleware('auth:api');
Route::put('/contratofornecedores/{contratofornecedor}', 'ContratoFornecedorController@update')->middleware('auth:api');
Route::delete('/contratofornecedores/{contratofornecedor}', 'ContratoFornecedorController@destroy')->middleware('auth:api');
Route::post('/contratofornecedores/upload', 'ContratoFornecedorController@upload')->middleware('auth:api');

Route::get('/contratos/downloadanexo', 'ContratoFornecedorController@downloadAnexo');

Route::get('/contratofornecedorservicos', 'ContratoFornecedorServicoController@index')->middleware('auth:api');
Route::post('/contratofornecedorservicos', 'ContratoFornecedorServicoController@store')->middleware('auth:api');
Route::get('/listcontratofornecedorservicos', 'ContratoFornecedorServicoController@listContratoFornecedorServico')->middleware('auth:api');
Route::get('/contratofornecedorservicos/{contratofornecedor}', 'ContratoFornecedorServicoController@show')->middleware('auth:api');
Route::put('/contratofornecedorservicos/{contratofornecedor}', 'ContratoFornecedorServicoController@update')->middleware('auth:api');
Route::delete('/contratofornecedorservicos/{contratofornecedor}', 'ContratoFornecedorServicoController@destroy')->middleware('auth:api');

Route::get('/contratoclientes', 'ContratoClienteController@index')->middleware('auth:api');
Route::post('/contratoclientes', 'ContratoClienteController@store')->middleware('auth:api');
Route::get('/listcontratoclientes', 'ContratoClienteController@listContratoCliente')->middleware('auth:api');
Route::get('/contratoclientes/{contratocliente}', 'ContratoClienteController@show')->middleware('auth:api');
Route::put('/contratoclientes/{contratocliente}', 'ContratoClienteController@update')->middleware('auth:api');
Route::delete('/contratoclientes/{contratocliente}', 'ContratoClienteController@destroy')->middleware('auth:api');
Route::post('/contratoclientes/upload', 'ContratoClienteController@upload')->middleware('auth:api');

Route::get('/contratoclienteservicos', 'ContratoClienteServicoController@index')->middleware('auth:api')->middleware('auth:api');
Route::post('/contratoclienteservicos', 'ContratoClienteServicoController@store')->middleware('auth:api')->middleware('auth:api');
Route::get('/listcontratoclienteservicos', 'ContratoClienteServicoController@listContratoClienteServico')->middleware('auth:api');
Route::get('/contratoclienteservicos/{contratoclienteservico}', 'ContratoClienteServicoController@show')->middleware('auth:api');
Route::put('/contratoclienteservicos/{contratoclienteservico}', 'ContratoClienteServicoController@update')->middleware('auth:api');
Route::delete('/contratoclienteservicos/{contratoclienteservico}', 'ContratoClienteServicoController@destroy')->middleware('auth:api');

Route::get('/manifestos', 'ManifestoController@index')->middleware('auth:api');
Route::post('/manifestos', 'ManifestoController@store')->middleware('auth:api');
Route::get('/listmanifestos', 'ManifestoController@listManifesto')->middleware('auth:api');
Route::get('/manifestos/{manifesto}', 'ManifestoController@show')->middleware('auth:api');
Route::put('/manifestos/{manifesto}', 'ManifestoController@update')->middleware('auth:api');
Route::delete('/manifestos/{manifesto}', 'ManifestoController@destroy')->middleware('auth:api');
Route::post('/manifestos/upload', 'ManifestoController@upload')->middleware('auth:api');

Route::get('/manifestos_anexo/downloadanexo', 'ManifestoController@downloadAnexo');

Route::get('/manifestoservicos', 'ManifestoServicoController@index')->middleware('auth:api');
Route::post('/manifestoservicos', 'ManifestoServicoController@store')->middleware('auth:api');
Route::get('/listmanifestoservicos', 'ManifestoServicoController@listManifestoServico')->middleware('auth:api');
Route::get('/manifestoservicos/{manifestoservico}', 'ManifestoServicoController@show')->middleware('auth:api');
Route::put('/manifestoservicos/{manifestoservico}', 'ManifestoServicoController@update')->middleware('auth:api');
Route::delete('/manifestoservicos/{manifestoservico}', 'ManifestoServicoController@destroy')->middleware('auth:api');


