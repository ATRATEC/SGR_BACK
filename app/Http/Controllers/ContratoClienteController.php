<?php

/**
 * Em classes onde existe a necessidade de informe de datas deve ser usado o DB::table no lugar 
 * da entidade.
 * Usando a entidade as data acabam vindo no formato yyyy-mm-dd hh:mm:ss isso faz com que o 
 * componente de exibição de data no html5 informe um erro de formato de data.
 */

namespace App\Http\Controllers;

use App\ContratoCliente;
use App\ContratoClienteServico;
use App\Exceptions\APIException;
use App\Cliente;
use App\Http\Resources\ContratoClienteCollection;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ContratoClienteController extends Controller {

    function __construct() {
        $this->content = array();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $nrcount = $request->input('nrcount', 15);
        $orderkey = $request->input('orderkey', 'id');
        $order = $request->input('order', 'asc');

        $arr = array();

        if ($request->has('id')) {
            $desc = array('id', '=', $request->input('id'));
            array_push($arr, $desc);
        }

        if ($request->has('vigencia_inicio')) {
            $desc = array('vigencia_inicio', '>=', $request->input('vigencia_inicio'));
            array_push($arr, $desc);
        }

        if ($request->has('vigencia_final')) {
            $desc = array('vigencia_final', '<=', $request->input('vigencia_final'));
            array_push($arr, $desc);
        }

        if ($request->has('descricao')) {
            $desc = array('descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }

        if ($request->has('cliente')) {
            $desc = array('cliente.razao_social', 'like', '%' . $request->input('cliente') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('id_cliente')) {
            $desc = array('contrato_cliente.id_cliente', '=', $request->input('id_cliente'));
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            $contratocliente = DB::table('contrato_cliente')
                            ->join('cliente', 'contrato_cliente.id_cliente', 'cliente.id')
                            ->join('contrato_fornecedor as cft', 'cft.id', 'contrato_cliente.id_transportador')
                            ->join('contrato_fornecedor as cfd', 'cfd.id', 'contrato_cliente.id_destinador')
                            ->join('fornecedor as ft', 'ft.id', 'cft.id_fornecedor')
                            ->join('fornecedor as fd', 'fd.id', 'cfd.id_fornecedor')
                            ->select('contrato_cliente.*', 'cliente.razao_social as cliente', 'ft.razao_social as transportador', 'fd.razao_social as destinador')
                            ->where($arr)
                            ->orderBy($orderkey, $order)->paginate($nrcount);
            // $contratocliente = new ContratoClienteCollection(ContratoCliente::with(['cliente','cliente','servicos'])->where($arr)->whereIn('id_cliente',$array_for)->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratocliente = DB::table('contratocliente')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $contratocliente = DB::table('contrato_cliente')
                            ->join('cliente', 'contrato_cliente.id_cliente', 'cliente.id')
                            ->join('contrato_fornecedor as cft', 'cft.id', 'contrato_cliente.id_transportador')
                            ->join('contrato_fornecedor as cfd', 'cfd.id', 'contrato_cliente.id_destinador')
                            ->join('fornecedor as ft', 'ft.id', 'cft.id_fornecedor')
                            ->join('fornecedor as fd', 'fd.id', 'cfd.id_fornecedor')
                            ->select('contrato_cliente.*', 'cliente.razao_social as cliente', 'ft.razao_social as transportador', 'fd.razao_social as destinador')
                            ->orderBy($orderkey, $order)->paginate($nrcount);
            // $contratocliente = new ContratoClienteCollection(ContratoCliente::with(['cliente','cliente','servicos'])->orderBy($orderkey, $order)->paginate($nrcount));
        }


        return response()->json($contratocliente, 200);
    }

    public function listContratoCliente() {
        $contratocliente = ContratoCliente::all();
        return response()->json($contratocliente, 200);
    }
    
    public function getTransportador($id) {
        $arr = array();
        
        $condid = array('cc.id', '=', $id);
        array_push($arr, $condid);
        
        $condsv = array('sv.id_tipo_atividade', '=', 1); // 1=TRANSPORTADOR
        array_push($arr, $condsv);
        
        
        $contratocliente = DB::table('contrato_cliente as cc')
                ->join('contrato_cliente_servico as ccs', 'ccs.id_contrato_cliente', 'cc.id')
                ->join('contrato_fornecedor as cf', 'cf.id', 'ccs.id_contrato_fornecedor')
                ->join('servico as sv', 'sv.id', 'ccs.id_servico')
                ->join('fornecedor as for', 'for.id', 'cf.id_fornecedor')
                ->select('for.*')
                ->where($arr)
                ->first();
        return response()->json($contratocliente, 200);
    }
    
    public function getDestinador($id) {
        $arr = array();
        
        $condid = array('cc.id', '=', $id);
        array_push($arr, $condid);
        
        $condsv = array('sv.id_tipo_atividade', '=', 2); // 2=DESTINADOR
        array_push($arr, $condsv);
        
        
        $contratocliente = DB::table('contrato_cliente as cc')
                ->join('contrato_cliente_servico as ccs', 'ccs.id_contrato_cliente', 'cc.id')
                ->join('contrato_fornecedor as cf', 'cf.id', 'ccs.id_contrato_fornecedor')
                ->join('servico as sv', 'sv.id', 'ccs.id_servico')
                ->join('fornecedor as for', 'for.id', 'cf.id_fornecedor')
                ->select('for.*')
                ->where($arr)
                ->first();
        return response()->json($contratocliente, 200);
    }
    
    public function getArmazenador($id) {
        $arr = array();
        
        $condid = array('cc.id', '=', $id);
        array_push($arr, $condid);
        
        $condsv = array('sv.id_tipo_atividade', '=', 3); // 3=ARMAZENADOR
        array_push($arr, $condsv);
        
        
        $contratocliente = DB::table('contrato_cliente as cc')
                ->join('contrato_cliente_servico as ccs', 'ccs.id_contrato_cliente', 'cc.id')
                ->join('contrato_fornecedor as cf', 'cf.id', 'ccs.id_contrato_fornecedor')
                ->join('servico as sv', 'sv.id', 'ccs.id_servico')
                ->join('fornecedor as for', 'for.id', 'cf.id_fornecedor')
                ->select('for.*')
                ->where($arr)
                ->first();
        return response()->json($contratocliente, 200);
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id_cliente' => 'required',
                    'vigencia_inicio' => 'required',
                    'vigencia_final' => 'required',                    
                        ], parent::$messages);

        return $validator;
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, ContratoCliente $contratocliente) {
        $validator = Validator::make($request->all(), [
                    'id_cliente' => 'required',
                    'vigencia_inicio' => 'required|date',
                    'vigencia_final' => 'required|date',                    
                        ], parent::$messages);

        return $validator;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = $this->ValitationStore($request);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }

        $contratocliente = new ContratoCliente();
        $contratocliente->fill($request->all());
        $contratocliente->save();

        $ctrfor = DB::table('contrato_cliente')
                ->join('cliente', 'contrato_cliente.id_cliente', 'cliente.id')
                ->join('contrato_fornecedor as cft', 'cft.id', 'contrato_cliente.id_transportador')
                ->join('contrato_fornecedor as cfd', 'cfd.id', 'contrato_cliente.id_destinador')
                ->join('fornecedor as ft', 'ft.id', 'cft.id_fornecedor')
                ->join('fornecedor as fd', 'fd.id', 'cfd.id_fornecedor')
                ->select('contrato_cliente.*', 'cliente.razao_social as cliente', 'ft.razao_social as transportador', 'fd.razao_social as destinador')
                ->where('contrato_cliente.id', '=', $contratocliente->id)
                ->first();


        return response()->json($ctrfor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contratocliente  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $contratocliente = DB::table('contrato_cliente')
                ->join('cliente', 'contrato_cliente.id_cliente', 'cliente.id')
                ->join('contrato_fornecedor as cft', 'cft.id', 'contrato_cliente.id_transportador')
                ->join('contrato_fornecedor as cfd', 'cfd.id', 'contrato_cliente.id_destinador')
                ->join('fornecedor as ft', 'ft.id', 'cft.id_fornecedor')
                ->join('fornecedor as fd', 'fd.id', 'cfd.id_fornecedor')
                ->select('contrato_cliente.*', 'cliente.razao_social as cliente', 'ft.razao_social as transportador', 'fd.razao_social as destinador')
                ->where('contrato_cliente.id', '=', $id)
                ->first();
        return response()->json($contratocliente, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contratocliente  $contratocliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContratoCliente $contratocliente) {
        $validator = $this->ValitationUpdate($request, $contratocliente);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }

        $contratocliente->update($request->all());

        $ctrfor = DB::table('contrato_cliente')
                ->join('cliente', 'contrato_cliente.id_cliente', 'cliente.id')
                ->join('contrato_fornecedor as cft', 'cft.id', 'contrato_cliente.id_transportador')
                ->join('contrato_fornecedor as cfd', 'cfd.id', 'contrato_cliente.id_destinador')
                ->join('fornecedor as ft', 'ft.id', 'cft.id_fornecedor')
                ->join('fornecedor as fd', 'fd.id', 'cfd.id_fornecedor')
                ->select('contrato_cliente.*', 'cliente.razao_social as cliente', 'ft.razao_social as transportador', 'fd.razao_social as destinador')
                ->where('contrato_cliente.id', '=', $contratocliente->id)
                ->first();

        return response()->json($ctrfor, 200);
    }

    public function upload(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id_cliente' => 'required',
                    'id_contrato' => 'required'
                        ], parent::$messages);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }


        $file = $request->arquivo;
        if (!is_null($file)) {
            $filename = $file->getClientOriginalName(); //getBasename();

            $id_cliente = $request->id_cliente;
            $id_contrato = $request->id_contrato;

            $contrato = ContratoCliente::find($id_contrato);

            if (!empty($contrato->caminho)) {
                $arquivoexclui = 'CLI_' . $id_cliente . '_CTR_' . $id_contrato . '_' . $contrato->caminho;
                $exists = Storage::disk('contratos')->exists($arquivoexclui);
                if ($exists) {
                    Storage::disk('contratos')->delete($arquivoexclui);
                }
            }

            $nomeArq = 'CLI_' . $id_cliente . '_CTR_' . $id_contrato . '_' . $filename;

            $exists = Storage::disk('contratos')->exists($nomeArq);
            if (!$exists) {
                Storage::disk('contratos')->putFileAs('', $request->file('arquivo'), $nomeArq);
            }

            $contrato->caminho = $filename;
            $contrato->save();
        }

        return response()->json(['anexo' => $filename], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contratocliente  $contratocliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContratoCliente $contratocliente) {
        ContratoClienteServico::where('id_contrato_cliente', $contratocliente->id)->delete();
        if (!empty($contratocliente->caminho)) {
            $arquivoexclui = 'CLI_' . $contratocliente->id_cliente . '_CTR_' . $contratocliente->id . '_' . $contratocliente->caminho;
            $exists = Storage::disk('contratos')->exists($arquivoexclui);
            if ($exists) {
                Storage::disk('contratos')->delete($arquivoexclui);
            }
        }
        $contratocliente->delete();
        return response()->json(null, 200);
    }

    public function downloadAnexo(Request $request) {
        $file_path = public_path('contratos/' . $request->arquivo);
        return response()->download($file_path);
    }

}
