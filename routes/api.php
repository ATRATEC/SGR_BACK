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
Route::get('/listtipotratamentos', 'TipoTratamentoController@listTipoTratamento')->middleware('auth:api');
Route::get('/tipotratamentos/{tipotratamento}', 'TipoTratamentoController@show')->middleware('auth:api');
Route::put('/tipotratamentos/{tipotratamento}', 'TipoTratamentoController@update')->middleware('auth:api');
Route::delete('/tipotratamentos/{tipotratamento}', 'TipoTratamentoController@destroy')->middleware('auth:api');

Route::get('/clientes', 'ClienteController@index');
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

Route::get('/clientedocumentos', 'ClienteDocumentoController@index')->middleware('auth:api');
Route::post('/clientedocumentos', 'ClienteDocumentoController@store')->middleware('auth:api');
Route::post('/clientedocumentos/upload', 'ClienteDocumentoController@upload')->middleware('auth:api');
Route::get('/clientedocumentos/{clientedocumento}', 'ClienteDocumentoController@show')->middleware('auth:api');
Route::put('/clientedocumentos/{clientedocumento}', 'ClienteDocumentoController@update')->middleware('auth:api');
Route::delete('/clientedocumentos/{clientedocumento}', 'ClienteDocumentoController@destroy')->middleware('auth:api');
Route::delete('/clientedocumentos/deleteanexo/{clientedocumento}', 'ClienteDocumentoController@deleteAnexo');
Route::get('/documentos/cliente/downloadanexo', 'ClienteDocumentoController@downloadAnexo');
Route::get('/clientedocumentos/listanexo/{clientedocumento}', 'ClienteDocumentoController@listClienteDocumentoAnexo')->middleware('auth:api');

Route::get('/monitordocumentos/clientes/{nrdias}', 'MonitorDocumentoController@showClienteDocumentos')->middleware('auth:api');
Route::get('/monitordocumentos/fornecedores/{nrdias}', 'MonitorDocumentoController@showFornecedorDocumentos')->middleware('auth:api');

Route::get('/fornecedordocumentos', 'FornecedorDocumentoController@index')->middleware('auth:api');
Route::post('/fornecedordocumentos', 'FornecedorDocumentoController@store')->middleware('auth:api');
Route::post('/fornecedordocumentos/upload', 'FornecedorDocumentoController@upload')->middleware('auth:api');
Route::get('/fornecedordocumentos/{fornecedordocumento}', 'FornecedorDocumentoController@show')->middleware('auth:api');
Route::put('/fornecedordocumentos/{fornecedordocumento}', 'FornecedorDocumentoController@update')->middleware('auth:api');
Route::delete('/fornecedordocumentos/{fornecedordocumento}', 'FornecedorDocumentoController@destroy')->middleware('auth:api');
Route::delete('/fornecedordocumentos/deleteanexo/{clientedocumento}', 'FornecedorDocumentoController@deleteAnexo');
Route::get('/documentos/fornecedor/downloadanexo', 'FornecedorDocumentoController@downloadAnexo');
Route::get('/fornecedordocumentos/listanexo/{clientedocumento}', 'FornecedorDocumentoController@listFornecedorDocumentoAnexo');


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
Route::get('/contratofornecedoresgrid', 'ContratoFornecedorController@indexGrid')->middleware('auth:api');
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

Route::get('/contratofornecedorresiduos', 'ContratoFornecedorResiduoController@index')->middleware('auth:api');
Route::post('/contratofornecedorresiduos', 'ContratoFornecedorResiduoController@store')->middleware('auth:api');
Route::get('/listcontratofornecedorresiduos', 'ContratoFornecedorResiduoController@listContratoFornecedorResiduo')->middleware('auth:api');
Route::get('/contratofornecedorresiduos/{contratofornecedorresiduo}', 'ContratoFornecedorResiduoController@show')->middleware('auth:api');
Route::put('/contratofornecedorresiduos/{contratofornecedorresiduo}', 'ContratoFornecedorResiduoController@update')->middleware('auth:api');
Route::delete('/contratofornecedorresiduos/{contratofornecedorresiduo}', 'ContratoFornecedorResiduoController@destroy')->middleware('auth:api');

Route::get('/contratoclientes', 'ContratoClienteController@index')->middleware('auth:api');
Route::post('/contratoclientes', 'ContratoClienteController@store')->middleware('auth:api');
Route::get('/listcontratoclientes', 'ContratoClienteController@listContratoCliente')->middleware('auth:api');
Route::get('/gettransportadorcontratoclientes/{contratocliente}', 'ContratoClienteController@getTransportador');
Route::get('/getdestinadorcontratoclientes/{contratocliente}', 'ContratoClienteController@getDestinador');
Route::get('/getarmazenadorcontratoclientes/{contratocliente}', 'ContratoClienteController@getArmazenador');
Route::get('/contratoclientes/{contratocliente}', 'ContratoClienteController@show')->middleware('auth:api');
Route::put('/contratoclientes/{contratocliente}', 'ContratoClienteController@update')->middleware('auth:api');
Route::delete('/contratoclientes/{contratocliente}', 'ContratoClienteController@destroy')->middleware('auth:api');
Route::post('/contratoclientes/upload', 'ContratoClienteController@upload')->middleware('auth:api');

Route::get('/contratoclienteresiduos', 'ContratoClienteResiduoController@index')->middleware('auth:api')->middleware('auth:api');
Route::post('/contratoclienteresiduos', 'ContratoClienteResiduoController@store')->middleware('auth:api')->middleware('auth:api');
Route::get('/listcontratoclienteresiduos', 'ContratoClienteResiduoController@listContratoClienteResiduo')->middleware('auth:api');
Route::get('/contratoclienteresiduos/{contratoclienteresiduo}', 'ContratoClienteResiduoController@show')->middleware('auth:api');
Route::put('/contratoclienteresiduos/{contratoclienteresiduo}', 'ContratoClienteResiduoController@update')->middleware('auth:api');
Route::delete('/contratoclienteresiduos/{contratoclienteresiduo}', 'ContratoClienteResiduoController@destroy')->middleware('auth:api');

Route::get('/contratoclienteequipamentos', 'ContratoClienteEquipamentoController@index')->middleware('auth:api');
Route::post('/contratoclienteequipamentos', 'ContratoClienteEquipamentoController@store')->middleware('auth:api');
Route::get('/listcontratoclienteequipamentos', 'ContratoClienteEquipamentoController@listContratoClienteEquipamento')->middleware('auth:api');
Route::get('/contratoclienteequipamentos/{contratoclienteequipamento}', 'ContratoClienteEquipamentoController@show')->middleware('auth:api');
Route::put('/contratoclienteequipamentos/{contratoclienteequipamento}', 'ContratoClienteEquipamentoController@update')->middleware('auth:api');
Route::delete('/contratoclienteequipamentos/{contratoclienteequipamento}', 'ContratoClienteEquipamentoController@destroy')->middleware('auth:api');

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
Route::get('/listresiduomanifestos', 'ManifestoServicoController@listResiduoManifesto')->middleware('auth:api');
Route::get('/manifestoservicos/{manifestoservico}', 'ManifestoServicoController@show')->middleware('auth:api');
Route::put('/manifestoservicos/{manifestoservico}', 'ManifestoServicoController@update')->middleware('auth:api');
Route::delete('/manifestoservicos/{manifestoservico}', 'ManifestoServicoController@destroy')->middleware('auth:api');

Route::get('/tiporesiduos', 'TipoResiduoController@index')->middleware('auth:api');
Route::post('/tiporesiduos', 'TipoResiduoController@store')->middleware('auth:api');
Route::get('/listtiporesiduos', 'TipoResiduoController@listTipoResiduo')->middleware('auth:api');
Route::get('/tiporesiduos/{tiporesiduo}', 'TipoResiduoController@show')->middleware('auth:api');
Route::put('/tiporesiduos/{tiporesiduo}', 'TipoResiduoController@update')->middleware('auth:api');
Route::delete('/tiporesiduos/{tiporesiduo}', 'TipoResiduoController@destroy')->middleware('auth:api');

Route::get('/equipamentos', 'EquipamentoController@index')->middleware('auth:api');
Route::post('/equipamentos', 'EquipamentoController@store')->middleware('auth:api');
Route::get('/listequipamentos', 'EquipamentoController@listEquipamento')->middleware('auth:api');
Route::get('/equipamentos/{equipamento}', 'EquipamentoController@show')->middleware('auth:api');
Route::put('/equipamentos/{equipamento}', 'EquipamentoController@update')->middleware('auth:api');
Route::delete('/equipamentos/{equipamento}', 'EquipamentoController@destroy')->middleware('auth:api');

Route::get('/locacoes', 'LocacaoController@index')->middleware('auth:api');
Route::post('/locacoes', 'LocacaoController@store')->middleware('auth:api');
Route::get('/listlocacoes', 'LocacaoController@listLocacao')->middleware('auth:api');
Route::get('/locacoes/{locacao}', 'LocacaoController@show')->middleware('auth:api');
Route::put('/locacoes/{locacao}', 'LocacaoController@update')->middleware('auth:api');
Route::delete('/locacoes/{locacao}', 'LocacaoController@destroy')->middleware('auth:api');

Route::get('/locacaoequipamentos', 'LocacaoEquipamentoController@index')->middleware('auth:api');
Route::post('/locacaoequipamentos', 'LocacaoEquipamentoController@store')->middleware('auth:api');
Route::get('/listlocacaoequipamentos', 'LocacaoEquipamentoController@listLocacaoEquipamento')->middleware('auth:api');
Route::get('/listequipamentolocacoes', 'LocacaoEquipamentoController@listEquipamentoLocacao')->middleware('auth:api');
Route::get('/locacaoequipamentos/{locacaoequipamento}', 'LocacaoEquipamentoController@show')->middleware('auth:api');
Route::put('/locacaoequipamentos/{locacaoequipamento}', 'LocacaoEquipamentoController@update')->middleware('auth:api');
Route::delete('/locacaoequipamentos/{locacaoequipamento}', 'LocacaoEquipamentoController@destroy')->middleware('auth:api');

Route::get('/pesagens', 'PesagemController@index')->middleware('auth:api');
Route::post('/pesagens', 'PesagemController@store')->middleware('auth:api');
Route::get('/listpesagens', 'PesagemController@listPesagem')->middleware('auth:api');
Route::get('/pesagens/{pesagem}', 'PesagemController@show')->middleware('auth:api');
Route::put('/pesagens/{pesagem}', 'PesagemController@update')->middleware('auth:api');
Route::delete('/pesagens/{pesagem}', 'PesagemController@destroy')->middleware('auth:api');

Route::get('/itempesagens', 'ItemPesagemController@index')->middleware('auth:api');
Route::post('/itempesagens', 'ItemPesagemController@store')->middleware('auth:api');
Route::get('/listitempesagens', 'ItemPesagemController@listItemPesagem')->middleware('auth:api');
Route::get('/listresiduoitempesagens', 'ItemPesagemController@listResiduoItemPesagem')->middleware('auth:api');
Route::get('/itempesagens/{itempesagem}', 'ItemPesagemController@show')->middleware('auth:api');
Route::put('/itempesagens/{itempesagem}', 'ItemPesagemController@update')->middleware('auth:api');
Route::delete('/itempesagens/{itempesagem}', 'ItemPesagemController@destroy')->middleware('auth:api');



//Route::get('/exibepdf', 'RelatoriosController@testepdf');
//Route::get('/exibeclientes', 'RelatoriosController@relcliente');
//Route::get('/exibeclientesxls/{type}', 'RelatoriosController@downloadExcel');
//Route::get('/relatorios/clientes', 'RelatoriosController@index');

Route::get('/relatorios/receitas', 'RelatoriosController@receita')->middleware('auth:api');
Route::get('/relatorios/receitaclientes', 'RelatoriosController@receitaCliente')->middleware('auth:api');
Route::get('/relatorios/despesaclientes', 'RelatoriosController@despesaCliente')->middleware('auth:api');
Route::get('/relatorios/locacaoclientes', 'RelatoriosController@locacaoCliente')->middleware('auth:api');
Route::get('/relatorios/despesas', 'RelatoriosController@despesa')->middleware('auth:api');
Route::get('/relatorios/printpdf2', 'RelatoriosController@relcliente')->middleware('auth:api');
//Route::post('/relatorios/printpdf', 'RelatoriosController@printHtml');
//Route::get('/relatorios/testeconsulta', 'RelatoriosController@testeconsulta')->middleware('auth:api');