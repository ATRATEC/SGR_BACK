<?php

namespace App\Http\Controllers;

use App\ClienteDocumento;
use App\Exceptions\APIException;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;
use DateInterval;

class MonitorDocumentoController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  $nrdias
     * @return \Illuminate\Http\Response
     */
    public function showClienteDocumentos($nrdias) {
        
        switch ($nrdias) {
            case 7:
                $data_inicio = date_create();
                $data_final = date_create();
                $i = new DateInterval('P7D');
                date_add($data_final, $i);             
                break;
            
            case 15:
                $data_inicio = date_create();
                $di = new DateInterval('P8D');
                date_add($data_inicio, $di); 
                
                $data_final = date_create();
                $df = new DateInterval('P15D');
                date_add($data_final, $df);             
                break;
            
            case 30:
                $data_inicio = date_create();
                $di = new DateInterval('P16D');
                date_add($data_inicio, $di); 
                
                $data_final = date_create();
                $df = new DateInterval('P30D');
                date_add($data_final, $df);             
                break;
            
            case 60:
                $data_inicio = date_create();
                $di = new DateInterval('P31D');
                date_add($data_inicio, $di); 
                
                $data_final = date_create();
                $df = new DateInterval('P60D');
                date_add($data_final, $df);             
                break;
            
            case 90:
                $data_inicio = date_create();
                $di = new DateInterval('P61D');
                date_add($data_inicio, $di); 
                
                $data_final = date_create();
                $df = new DateInterval('P90D');
                date_add($data_final, $df);             
                break;

            default:
                $data_inicio = date_create();
                $data_final = date_create();
                break;
        } 
                                     
        $documento = DB::table('cliente_documento')                        
                        ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                        ->join('tipo_documento', 'cliente_documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('cliente_documento.*', 'tipo_documento.descricao', 'cliente.razao_social', 'cliente_documento.id_cliente')
                        ->whereBetween('cliente_documento.vencimento', [$data_inicio, $data_final])->get();
        return response()->json($documento, 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  $nrdias
     * @return \Illuminate\Http\Response
     */
    public function showFornecedorDocumentos($nrdias) {
        
        switch ($nrdias) {
            case 7:
                $data_inicio = date_create();
                $data_final = date_create();
                $i = new DateInterval('P7D');
                date_add($data_final, $i);             
                break;
            
            case 15:
                $data_inicio = date_create();
                $di = new DateInterval('P8D');
                date_add($data_inicio, $di); 
                
                $data_final = date_create();
                $df = new DateInterval('P15D');
                date_add($data_final, $df);             
                break;
            
            case 30:
                $data_inicio = date_create();
                $di = new DateInterval('P16D');
                date_add($data_inicio, $di); 
                
                $data_final = date_create();
                $df = new DateInterval('P30D');
                date_add($data_final, $df);             
                break;
            
            case 60:
                $data_inicio = date_create();
                $di = new DateInterval('P31D');
                date_add($data_inicio, $di); 
                
                $data_final = date_create();
                $df = new DateInterval('P60D');
                date_add($data_final, $df);             
                break;
            
            case 90:
                $data_inicio = date_create();
                $di = new DateInterval('P61D');
                date_add($data_inicio, $di); 
                
                $data_final = date_create();
                $df = new DateInterval('P90D');
                date_add($data_final, $df);             
                break;

            default:
                $data_inicio = date_create();
                $data_final = date_create();
                break;
        } 
                                     
        $documento = DB::table('fornecedor_documento')                        
                        ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                        ->join('tipo_documento', 'fornecedor_documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('fornecedor_documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                        ->whereBetween('fornecedor_documento.vencimento', [$data_inicio, $data_final])->get();
        return response()->json($documento, 200);
    }
}
