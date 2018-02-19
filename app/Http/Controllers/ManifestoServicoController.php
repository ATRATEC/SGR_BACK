<?php

namespace App\Http\Controllers;

use App\ManifestoServico;
use App\Servico;
use App\Manifesto;
use App\Http\Resources\ManifestoServicoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ManifestoServicoController extends Controller {

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

        if ($request->has('id_contrato')) {
            $desc = array('id_contrato', '=', $request->input('id_contrato'));
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            $Manifestoservico = new ManifestoServicoCollection(ManifestoServico::where($arr)->with(['contrato_fornecedor', 'servico'])->orderBy($orderkey, $order)->paginate($nrcount));
            // $Manifestoservico = DB::table('Manifestoservico')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $Manifestoservico = new ManifestoServicoCollection(ManifestoServico::with(['contrato_fornecedor', 'fornecedor', 'servico'])->orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $Manifestoservico->response()->setStatusCode(200); //response()->json($Manifestoservico,200);
    }

    
    public function listManifestoServico() {
        $Manifestoservico = ManifestoServico::all();
        return response()->json($Manifestoservico, 200);
    }
    
    /**
     * Lista residuos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listResiduoManifesto(Request $request) {
        $arr = array();
        $arr2 = array();
        

        if ($request->has('id_contrato_cliente')) {
            $desc = array('ccr.id_contrato_cliente', '=', $request->input('id_contrato_cliente'));            
            array_push($arr, $desc);
            array_push($arr2, $desc);
        }
        
//        $desc = array('ccr.id_contrato_cliente', '=', 3);
//            array_push($arr, $desc);

        if ($request->has('id_destinador')) {
            $desc = array('cf.id_fornecedor', '=', $request->input('id_destinador'));            
            array_push($arr, $desc);
        }
        
        if ($request->has('id_transportador')) {
            $desc = array('cf.id_fornecedor', '=', $request->input('id_transportador'));            
            array_push($arr2, $desc);
        }
        
//        $desc2 = array('cf.id_fornecedor', '=', 3);
//            array_push($arr, $desc2);
        
        $lista = DB::table('contrato_cliente_residuo as ccr')
                    ->join('contrato_fornecedor as cf', 'ccr.id_contrato_fornecedor', 'cf.id')                    
                    ->join('residuo as res', 'ccr.id_residuo', 'res.id')
                    ->join('tipo_residuo as tr', 'res.id_tipo_residuo', 'tr.id')
                    ->join('acondicionamento as ac', 'res.id_acondicionamento', 'ac.id')
                    ->join('tipo_tratamento as tt', 'res.id_tratamento', 'tt.id')
                    ->select('res.id as id_residuo','res.id_tipo_residuo','res.id_acondicionamento','res.id_tratamento','ccr.unidade', 'tr.descricao as tipo_residuo', 'res.descricao as residuo', 'ac.descricao as acondicionamento','tt.descricao as tratamento')
                    ->where($arr)
                    ->orWhere($arr2)
                    ->groupBy('res.id','res.id_tipo_residuo','res.id_acondicionamento','res.id_tratamento','ccr.unidade', 'tr.descricao', 'res.descricao', 'ac.descricao', 'tt.descricao')
                    ->orderBy('res.descricao')
                    ->get();
            return response()->json($lista, 201);
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \App\ManifestoServico  $Manifestoservico
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(ManifestoServico $Manifestoservico) {
        $validator = Validator::make($Manifestoservico->toArray(), [
                    'id_manifesto' => 'required',                    
                    'id_residuo' => 'required',                    
                    'id_tipo_residuo' => 'required',
                    'id_acondicionamento' => 'required',
                    'id_tratamento' => 'required',
                    'unidade' => 'required',
                    'quantidade' => 'required',                    
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
        if ($request->has('data')) {
            $id = $request->id;
            $data = $request->data;
                        
            foreach ($data as $item) {
                if (isset($item['id'])) {
                    //Fluxo de atualização / deleção                    
                    $contratoservico = ManifestoServico::find($item['id']);
                    $contratoservico->fill($item);
                    $validator = $this->Valitation($contratoservico);

                    if ($validator->fails()) {
                        return response()->json([
                                    'error' => 'Validação falhou',
                                    'message' => $validator->errors()->all(),
                                        ], 422);
                    }
                    $contratoservico->save();
                } else {
                    //fluxo de criação
                    $contratoservico = new ManifestoServico();
                    $contratoservico->fill($item);
                    $validator = $this->Valitation($contratoservico);

                    if ($validator->fails()) {
                        return response()->json([
                                    'error' => 'Validação falhou',
                                    'message' => $validator->errors()->all(),
                                        ], 422);
                    }
                    $contratoservico->save();
                }
            }

            $lista = DB::table('manifesto_servico')
                    ->join('manifesto', 'id_manifesto', 'manifesto.id')                    
                    ->join('residuo', 'manifesto_servico.id_residuo', 'residuo.id')
                    ->join('tipo_residuo', 'manifesto_servico.id_tipo_residuo', 'tipo_residuo.id')
                    ->join('acondicionamento', 'manifesto_servico.id_acondicionamento', 'acondicionamento.id')
                    ->join('tipo_tratamento', 'manifesto_servico.id_tratamento', 'tipo_tratamento.id')
                    ->select('manifesto_servico.*', 'tipo_residuo.descricao as tipo_residuo', 'residuo.descricao as residuo', 'acondicionamento.descricao as acondicionamento','tipo_tratamento.descricao as tratamento')
                    ->where('manifesto_servico.id_manifesto', '=', $id)
                    ->get();
            return response()->json($lista, 201);
        }
        return response()->json([
                    'error' => 'Validação falhou',
                    'message' => 'Nenhum dado enviado para gravação',
                        ], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manifestoservico  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // $Manifestoservico = ManifestoServico::where('id_contrato_cliente', $id)->get();
        $lista = DB::table('manifesto_servico')
                    ->join('manifesto', 'id_manifesto', 'manifesto.id')                    
                    ->join('residuo', 'manifesto_servico.id_residuo', 'residuo.id')
                    ->join('tipo_residuo', 'manifesto_servico.id_tipo_residuo', 'tipo_residuo.id')
                    ->join('acondicionamento', 'manifesto_servico.id_acondicionamento', 'acondicionamento.id')
                    ->join('tipo_tratamento', 'manifesto_servico.id_tratamento', 'tipo_tratamento.id')
                    ->select('manifesto_servico.*', 'tipo_residuo.descricao as tipo_residuo', 'residuo.descricao as residuo', 'acondicionamento.descricao as acondicionamento','tipo_tratamento.descricao as tratamento')
                    ->where('manifesto_servico.id_manifesto', '=', $id)
                    ->get();
        //return response()->json($Manifestoservico, 200);
        return response()->json($lista, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manifesto  $contratofornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manifesto $contratofornecedor) {
        if ($request->has('data')) {
            $data = $request->data;
            $id = $data[0]['id_contrato'];

            foreach ($data as $item) {
                $contratoservico = ManifestoServico::find($item['id']);
                $contratoservico->fill($item);
                $validator = $this->Valitation($contratoservico);

                if ($validator->fails()) {
                    return response()->json([
                                'error' => 'Validação falhou',
                                'message' => $validator->errors()->all(),
                                    ], 422);
                }

                $contratoservico->save();
            }

            $lista = DB::table('manifesto_servico')
                    ->join('manifesto', 'id_manifesto', 'manifesto.id')                    
                    ->join('residuo', 'manifesto_servico.id_residuo', 'residuo.id')
                    ->join('tipo_residuo', 'manifesto_servico.id_tipo_residuo', 'tipo_residuo.id')
                    ->join('acondicionamento', 'manifesto_servico.id_acondicionamento', 'acondicionamento.id')
                    ->join('tipo_tratamento', 'manifesto_servico.id_tratamento', 'tipo_tratamento.id')
                    ->select('manifesto_servico.*', 'tipo_residuo.descricao as tipo_residuo', 'residuo.descricao as residuo', 'acondicionamento.descricao as acondicionamento','tipo_tratamento.descricao as tratamento')
                    ->where('manifesto_servico.id_manifesto', '=', $id)
                    ->get();
            return response()->json($lista, 201);
        }
        return response()->json([
                    'error' => 'Validação falhou',
                    'message' => 'Nenhum dado enviado para gravação',
                        ], 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manifestoservico  $Manifestoservico
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManifestoServico $Manifestoservico) {
        $Manifestoservico->delete();
        return response()->json(null, 200);
    }
        
}
