<?php

/**
 * Em classes onde existe a necessidade de informe de datas deve ser usado o DB::table no lugar 
 * da entidade.
 * Usando a entidade as data acabam vindo no formato yyyy-mm-dd hh:mm:ss isso faz com que o 
 * componente de exibição de data no html5 informe um erro de formato de data.
 */

namespace App\Http\Controllers;

use App\Manifesto;
use App\ManifestoServico;
use App\Exceptions\APIException;
use App\Fornecedor;
use App\Cliente;
use App\Http\Resources\ManifestoCollection;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ManifestoController extends Controller
{
    function __construct() {
        $this->content = array();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nrcount = $request->input('nrcount', 15);
        $orderkey = $request->input('orderkey', 'id');
        $order = $request->input('order', 'asc');

        $arr = array();

        if ($request->has('id')) {
            $desc = array('id', '=', $request->input('id'));
            array_push($arr, $desc);
        }
        
        if ($request->has('data')) {
            $desc = array('data', '>=', $request->input('data'));
            array_push($arr, $desc);
        }
                      
        if ($request->has('numero')) {
            $desc = array('numero', 'like', '%' . $request->input('numero') . '%');
            array_push($arr, $desc);
        }
                        
        if ($request->has('cliente')) {
            $desc = array('cliente.razao_social', 'like', '%' . $request->input('cliente') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('transportador')) {
            $desc = array('f1.nome_fantasia', 'like', '%' . $request->input('transportador') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('destinador')) {
            $desc = array('f2.nome_fantasia', 'like', '%' . $request->input('destinador') . '%');
            array_push($arr, $desc);
        }
                                      
        if (count($arr) > 0) {            
            $Manifesto = DB::table('manifesto')
                ->join('cliente', 'id_cliente', 'cliente.id')      
                ->join('fornecedor as f1', 'id_transportador','f1.id')
                ->join('fornecedor as f2', 'id_destinador', 'f2.id')
                ->join('contrato_cliente','id_contrato_cliente', 'contrato_cliente.id')
                ->select('manifesto.*', 'cliente.razao_social as cliente', 'contrato_cliente.descricao as descricao',
                        'f1.nome_fantasia as transportador','f2.nome_fantasia as destinador')
                ->where($arr)
                ->orderBy($orderkey, $order)->paginate($nrcount);
            // $Manifesto = new ManifestoCollection(Manifesto::with(['cliente','fornecedor','servicos'])->where($arr)->whereIn('id_fornecedor',$array_for)->orderBy($orderkey, $order)->paginate($nrcount));
            // $Manifesto = DB::table('Manifesto')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $Manifesto = DB::table('manifesto')
                ->join('cliente', 'id_cliente', 'cliente.id') 
                ->join('fornecedor as f1', 'id_transportador','f1.id')
                ->join('fornecedor as f2', 'id_destinador', 'f2.id')
                ->join('contrato_cliente','id_contrato_cliente', 'contrato_cliente.id')
                ->select('manifesto.*', 'cliente.razao_social as cliente', 'contrato_cliente.descricao as descricao',
                        'f1.nome_fantasia as transportador','f2.nome_fantasia as destinador')
                ->orderBy($orderkey, $order)->paginate($nrcount);
            // $Manifesto = new ManifestoCollection(Manifesto::with(['cliente','fornecedor','servicos'])->orderBy($orderkey, $order)->paginate($nrcount));
        }


        return response()->json($Manifesto,200);
    }
    
    public function listManifesto()
    {
        $Manifesto = Manifesto::all();
        return response()->json($Manifesto, 200);
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
                    'id_contrato_cliente' => 'required',
                    'id_transportador' => 'required',
                    'id_destinador' => 'required',
                    'data' => 'required',
                    'numero' => 'required|unique:manifesto|max:20',
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, Manifesto $manifesto) {        
        $validator = Validator::make($request->all(), [                            
                    'id_cliente' => 'required',
                    'id_contrato_cliente' => 'required',
                    'id_transportador' => 'required',
                    'id_destinador' => 'required',
                    'data' => 'required',
                    'numero' => ['required',
                                    Rule::unique('manifesto')->ignore($manifesto->id),
                                    'max:20'],
        ], parent::$messages);

        return $validator;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->ValitationStore($request);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }

        $Manifesto = new Manifesto();
        $Manifesto->fill($request->all());
        $Manifesto->save();
        
        $ctrfor = DB::table('manifesto')
                ->join('cliente', 'id_cliente', 'cliente.id') 
                ->join('fornecedor as f1', 'id_transportador','f1.id')
                ->join('fornecedor as f2', 'id_destinador', 'f2.id')
                ->join('contrato_cliente','id_contrato_cliente', 'contrato_cliente.id')
                ->select('manifesto.*', 'cliente.razao_social as cliente', 'contrato_cliente.descricao as descricao',
                        'f1.nome_fantasia as transportador','f2.nome_fantasia as destinador')
                ->where('manifesto.id', '=', $Manifesto->id)
                ->first();
        
        
        return response()->json($ctrfor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manifesto  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Manifesto = DB::table('manifesto')                
                ->join('cliente', 'id_cliente', 'cliente.id')
                ->join('fornecedor as f1', 'id_transportador','f1.id')
                ->join('fornecedor as f2', 'id_destinador', 'f2.id')
                ->join('contrato_cliente','id_contrato_cliente', 'contrato_cliente.id')
                ->select('manifesto.*', 'cliente.razao_social as cliente', 'contrato_cliente.descricao as descricao',
                        'f1.nome_fantasia as transportador','f2.nome_fantasia as destinador')
                ->where('manifesto.id', '=', $id)
                ->first();
        return response()->json($Manifesto, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manifesto  $Manifesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manifesto $Manifesto)
    {
        $validator = $this->ValitationUpdate($request, $Manifesto);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $Manifesto->update($request->all());
        
        $ctrfor = DB::table('manifesto')                
                ->join('cliente', 'id_cliente', 'cliente.id')
                ->join('fornecedor as f1', 'id_transportador','f1.id')
                ->join('fornecedor as f2', 'id_destinador', 'f2.id')
                ->join('contrato_cliente','id_contrato_cliente', 'contrato_cliente.id')
                ->select('manifesto.*', 'cliente.razao_social as cliente', 'contrato_cliente.descricao as descricao',
                        'f1.nome_fantasia as transportador','f2.nome_fantasia as destinador')
                ->where('manifesto.id', '=', $Manifesto->id)
                ->first();

        return response()->json($ctrfor, 200);
    }
    
    public function upload(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id_cliente' => 'required',
                    'id_manifesto' => 'required'
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
            $id_manifesto = $request->id_manifesto;

            $manifesto = Manifesto::find($id_manifesto);

            if (!empty($manifesto->caminho)) {
                $arquivoexclui = 'CLI_' . $id_cliente . '_MTR_' . $id_manifesto . '_' . $manifesto->caminho;
                $exists = Storage::disk('manifestos_anexo')->exists($arquivoexclui);
                if ($exists) {
                    Storage::disk('manifestos_anexo')->delete($arquivoexclui);
                }
            }

            $nomeArq = 'CLI_' . $id_cliente . '_MTR_' . $id_manifesto . '_' . $filename;

            $exists = Storage::disk('manifestos_anexo')->exists($nomeArq);
            if (!$exists) {
                Storage::disk('manifestos_anexo')->putFileAs('', $request->file('arquivo'), $nomeArq);
            }

            $manifesto->caminho = $filename;
            $manifesto->save();
        }

        return response()->json(['anexo' => $filename], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manifesto  $Manifesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manifesto $Manifesto)
    {
        ManifestoServico::where('id_manifesto', $Manifesto->id)->delete();
        if (!empty($Manifesto->caminho)) {
            $arquivoexclui = 'CLI_' . $Manifesto->id_cliente . '_MTR_' . $Manifesto->id . '_' . $Manifesto->caminho;
            $exists = Storage::disk('manifestos_anexo')->exists($arquivoexclui);
            if ($exists) {
                Storage::disk('manifestos_anexo')->delete($arquivoexclui);
            }
        }
        $Manifesto->delete();
        return response()->json(null, 200);
    }
    
    public function downloadAnexo(Request $request) {
        $file_path = public_path('manifestos_anexo/'.$request->arquivo);
        return response()->download($file_path);
    }
}
