<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Cliente;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use JasperPHP\JasperPHP;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class RelatoriosController extends Controller
{

    /**
     * Reporna um array com os parametros de conexão
     * @return Array
     */
    public function getDatabaseConfig()
    {
        return [
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'database' => env('DB_DATABASE'),
            'jdbc_dir' => base_path() . env('JDBC_DIR', '/vendor/lavela/phpjasper/src/JasperStarter/jdbc'),
        ];
    }

    public function index()
    {
        // coloca na variavel o caminho do novo relatório que será gerado
        $output = public_path() . '/relatorios/' . time() . '_Clientes';
        // instancia um novo objeto JasperPHP

        $report = new JasperPHP;
        // chama o método que irá gerar o relatório
        // passamos por parametro:
        // o arquivo do relatório com seu caminho completo
        // o nome do arquivo que será gerado
        // o tipo de saída
        // parametros ( nesse caso não tem nenhum)         
        $report->process(
                public_path() . '/relatorios/clientes.jrxml', $output, ['pdf'], ['param_id' => 1], $this->getDatabaseConfig()
        )->execute();
        $file = $output . '.pdf';
        $path = $file;

        // caso o arquivo não tenha sido gerado retorno um erro 404
        if (!file_exists($file)) {
            abort(404);
        }
        //caso tenha sido gerado pego o conteudo
        $file = file_get_contents($file);
        //deleto o arquivo gerado, pois iremos mandar o conteudo para o navegador
        unlink($path);
        // retornamos o conteudo para o navegador que íra abrir o PDF
        return response($file, 200)
                        ->header('Content-Type', 'application/pdf')
                        ->header('Content-Disposition', 'inline; filename="cliente.pdf"');
    }

    public function receita(Request $request)
    {
        $arr = array();

        if ($request->has('id_cliente')) {
            $arr['pid_cliente'] = $request->input('id_cliente');
//            $desc = ['pid_cliente' => $request->input('id_cliente')];            
//            array_push($arr, $desc);
        }

        if ($request->has('id_manifesto')) {
            $arr['pid_manifesto'] = $request->input('id_manifesto');
//            $desc = array('pid_manifesto', $request->input('id_manifesto'));
//            array_push($arr, $desc);
        }

        if ($request->has('datade')) {
            $arr['pdatade'] = $request->input('datade');
//            $desc = array('pdatade', $request->input('datade'));
//            array_push($arr, $desc);
        }

        if ($request->has('dataate')) {
            $arr['pdataate'] = $request->input('dataate');
//            $desc = array('pdataate', $request->input('dataate'));
//            array_push($arr, $desc);
        }

        if ($request->has('id_contratocli')) {
            $arr['pid_contratocli'] = $request->input('id_contratocli');
//            $desc = array('pid_contratocli', $request->input('id_contratocli'));
//            array_push($arr, $desc);
        }


        $arr['pUrlBase'] = public_path() . '/relatorios/logo_av.png';

        // coloca na variavel o caminho do novo relatório que será gerado
        $output = public_path() . '/relatorios/' . time() . '_Receita';
        // instancia um novo objeto JasperPHP

        $report = new JasperPHP;
        // chama o método que irá gerar o relatório
        // passamos por parametro:
        // o arquivo do relatório com seu caminho completo
        // o nome do arquivo que será gerado
        // o tipo de saída
        // parametros ( nesse caso não tem nenhum)         
        $report->process(
                public_path() . '/relatorios/receita.jasper', $output, ['pdf'], $arr, $this->getDatabaseConfig()
        )->execute();
        $file = $output . '.pdf';
        $path = $file;

        // caso o arquivo não tenha sido gerado retorno um erro 404
        if (!file_exists($file)) {
            abort(404);
        }
        //caso tenha sido gerado pego o conteudo
        $file = file_get_contents($file);
        //deleto o arquivo gerado, pois iremos mandar o conteudo para o navegador
        unlink($path);
        // retornamos o conteudo para o navegador que íra abrir o PDF
        return response($file, 200)
                        ->header('Content-Type', 'application/pdf')
                        ->header('Content-Disposition', 'inline; filename="receita.pdf"');
    }

    public function receitaCliente(Request $request)
    {
        $lista = $this->ConsultaReceitaCliente($request);
        
        return response()->json($lista, 200);
//        $arr = array();
//
//        if ($request->has('id_cliente')) {
//            $arr['pid_cliente'] = $request->input('id_cliente');
//        }
//
//        if ($request->has('id_manifesto')) {
//            $arr['pid_manifesto'] = $request->input('id_manifesto');
//
//        }
//
//        if ($request->has('datade')) {
//            $arr['pdatade'] = $request->input('datade');
//        }
//
//        if ($request->has('dataate')) {
//            $arr['pdataate'] = $request->input('dataate');
//        }
//
//        if ($request->has('id_contratocli')) {
//            $arr['pid_contratocli'] = $request->input('id_contratocli');
//        }
//
//        //Passa por parametro a imagem de logo do relatório.
//        $arr['pUrlBase'] = public_path() . '/relatorios/logo_av.png';
//
//        // coloca na variavel o caminho do novo relatório que será gerado
//        $output = public_path() . '/relatorios/' . time() . '_ReceitaCliente';
//        // instancia um novo objeto JasperPHP
//
//        $report = new JasperPHP;
//        // chama o método que irá gerar o relatório
//        // passamos por parametro:
//        // o arquivo do relatório com seu caminho completo
//        // o nome do arquivo que será gerado
//        // o tipo de saída
//        // parametros ( nesse caso não tem nenhum)         
//        $report->process(
//                public_path() . '/relatorios/receita_cliente.jasper', $output, ['pdf'], $arr, $this->getDatabaseConfig()
//        )->execute();
//        $file = $output . '.pdf';
//        $path = $file;
//
//        // caso o arquivo não tenha sido gerado retorno um erro 404
//        if (!file_exists($file)) {
//            abort(404);
//        }
//        //caso tenha sido gerado pego o conteudo
//        $file = file_get_contents($file);
//        //deleto o arquivo gerado, pois iremos mandar o conteudo para o navegador
//        unlink($path);
//        // retornamos o conteudo para o navegador que íra abrir o PDF
//        return response($file, 200)
//                        ->header('Content-Type', 'application/pdf')
//                        ->header('Content-Disposition', 'inline; filename="receita_cliente.pdf"');
    }
    
    public function despesaCliente(Request $request)
    {
        $lista = $this->ConsultaDespesaCliente($request);
        
        return response()->json($lista, 200);
    }
    
    public function locacaoCliente(Request $request)
    {
        $lista = $this->ConsultaLocacoesCliente($request);
        
        return response()->json($lista, 200);
    }

    public function despesa(Request $request)
    {
        $arr = array();

        if ($request->has('id_cliente')) {
            $arr['pid_cliente'] = $request->input('id_cliente');
//            $desc = ['pid_cliente' => $request->input('id_cliente')];            
//            array_push($arr, $desc);
        }

        if ($request->has('id_manifesto')) {
            $arr['pid_manifesto'] = $request->input('id_manifesto');
//            $desc = array('pid_manifesto', $request->input('id_manifesto'));
//            array_push($arr, $desc);
        }

        if ($request->has('datade')) {
            $arr['pdatade'] = $request->input('datade');
//            $desc = array('pdatade', $request->input('datade'));
//            array_push($arr, $desc);
        }

        if ($request->has('dataate')) {
            $arr['pdataate'] = $request->input('dataate');
//            $desc = array('pdataate', $request->input('dataate'));
//            array_push($arr, $desc);
        }

        if ($request->has('id_contratocli')) {
            $arr['pid_contratocli'] = $request->input('id_contratocli');
//            $desc = array('pid_contratocli', $request->input('id_contratocli'));
//            array_push($arr, $desc);
        }

        //Passa por parametro a imagem de logo do relatório.
        $arr['pUrlBase'] = public_path() . '/relatorios/logo_av.png';

        // coloca na variavel o caminho do novo relatório que será gesrado
        $output = public_path() . '/relatorios/' . time() . '_Despesa';
        // instancia um novo objeto JasperPHP

        $report = new JasperPHP;
        // chama o método que irá gerar o relatório
        // passamos por parametro:
        // o arquivo do relatório com seu caminho completo
        // o nome do arquivo que será gerado
        // o tipo de saída
        // parametros ( nesse caso não tem nenhum)         
        $report->process(
                public_path() . '/relatorios/despesa.jasper', $output, ['pdf'], $arr, $this->getDatabaseConfig()
        )->execute();
        $file = $output . '.pdf';
        $path = $file;

        // caso o arquivo não tenha sido gerado retorno um erro 404
        if (!file_exists($file)) {
            abort(404);
        }
        //caso tenha sido gerado pego o conteudo
        $file = file_get_contents($file);
        //deleto o arquivo gerado, pois iremos mandar o conteudo para o navegador
        unlink($path);
        // retornamos o conteudo para o navegador que íra abrir o PDF
        return response($file, 200)
                        ->header('Content-Type', 'application/pdf')
                        ->header('Content-Disposition', 'inline; filename="despesa.pdf"');
    }

    public function testepdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }
    
    public function printHtml(Request $request) 
    {
        if ($request->has('conteudo')){
            $conteudo = $request->conteudo;
        }
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($conteudo);
        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function relcliente(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $periodode = '01/01/2018';
        $periodoate = '31/12/2018';
        $cliente = Cliente::find(30);
        $receitas = $this->ConsultaReceitaCliente($request);
//        return view('relatorio.clientes', ['clientes' => $clientes,]);
        $pdf = PDF::loadView('relatorio.clientes2', ['receitas' => $receitas, 'periodode' => $periodode, 'periodoate' => $periodoate, 'cliente' => $cliente]);
//        return $pdf->download('clientes.pdf');
//        return $pdf->setPaper('a4', 'landscape')->save(public_path() . '/relatorios/my_stored_file.pdf')->stream();;
        return $pdf->setPaper('a4', 'landscape')->stream();
    }
    
    public function testeconsulta()
    {
//        $query = 'select '												
//                .'  man.data as Data_Coleta, '
//                .'  man.numero as Manifesto, '
//                .'  man.id_cliente, '
//                .'  cli.razao_social as Cliente, '
//                .'  res.descricao as Residuo, '
//                .'  f1.nome_fantasia as Transportador, '
//                .'  f2.nome_fantasia as Destinador, '
//                .'  ms.quantidade as Qtd, '
//                .'  ms.unidade as Und, '
//                .'  ccr.preco_compra as ValUnit, '
//                .'  ms.quantidade * ccr.preco_compra as Total '
//                .'from '
//                .'  manifesto man '
//                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto '
//                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente '
//                .'  inner join ( '
//                .'	select '
//                .'		ccrg.id_contrato_cliente, '
//                .'		ccrg.id_residuo, '
//                .'		sum(ccrg.preco_compra) as preco_compra '
//                .'	from '
//                .'		contrato_cliente_residuo ccrg '
//                .'	group by '
//                .'		ccrg.id_contrato_cliente, '
//                .'		ccrg.id_residuo) ccr '
//                .'  on (ccr.id_contrato_cliente = cc.id and ms.id_residuo = ccr.id_residuo) '
//                .'  inner join cliente cli on cli.id = man.id_cliente '
//                .'  inner join fornecedor f1 on f1.id = man.id_transportador '
//                .'  inner join fornecedor f2 ON f2.id = man.id_destinador '
//                .'  inner join residuo res on res.id = ms.id_residuo '
//                .'  where res.id = 3';
//        $resultado = DB::select($query);
        
        $resultado = $this->ConsultaReceitaCliente();
        
        return response()->json($resultado, 200);
    }
    
    private function ConsultaReceitaCliente(Request $request)
    {        
        $query = 'select '												
                .'  man.data as coleta, '
                .'  man.numero as manifesto, '
                .'  man.id_cliente, '
                .'  cli.razao_social as cliente, '
                .'  res.descricao as residuo, '
                .'  f1.nome_fantasia as transportador, '
                .'  f2.nome_fantasia as destinador, '
                .'  tt.descricao as tratamento,'
                .'  ms.quantidade as quantidade, '
                .'  ms.unidade as unidade, '
                .'  ccr.preco_compra as valor_unitario, '
                .'  ms.quantidade * ccr.preco_compra as valor_total '
                .'from '
                .'  manifesto man '
                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto '
                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente '
                .'  inner join ( '
                .'	select '
                .'		ccrg.id_contrato_cliente, '
                .'		ccrg.id_contrato_fornecedor, '
                .'		ccrg.id_residuo, '                
                .'		sum(ccrg.preco_compra) as preco_compra '
                .'	from '
                .'		contrato_cliente_residuo ccrg '
                .'	group by '
                .'		ccrg.id_contrato_cliente, '
                .'		ccrg.id_contrato_fornecedor, '
                .'		ccrg.id_residuo) ccr '
                .'  on (ccr.id_contrato_cliente = cc.id and ms.id_residuo = ccr.id_residuo) '
                .'  inner join cliente cli on cli.id = man.id_cliente '
                .'  inner join fornecedor f1 on f1.id = man.id_transportador '
                .'  inner join fornecedor f2 ON f2.id = man.id_destinador '
                .'  inner join residuo res on res.id = ms.id_residuo '
                .'  inner join tipo_tratamento tt on tt.id = ms.id_tratamento'
                .'  where ccr.preco_compra > 0';
                
                if ($request->has('id_cliente')) {
                    $query = $query.'  and man.id_cliente = ' . $request->input('id_cliente');                    
                }
                
                if ($request->has('id_manifesto')) {
                    $query = $query.'  and man.id = ' . $request->input('id_manifesto');
                }

                if ($request->has('datade')) {
                    $query = $query.'  and man.data >= date(' .$request->input('datade').')';
                }

                if ($request->has('dataate')) {
                    $query = $query.'  and man.data <= date(' .$request->input('dataate').')';
                }
                
                if ($request->has('id_residuo')) {
                    $query = $query.'  and res.id = ' . $request->input('id_residuo');
                }

                
                $query = $query.'  order by man.id_cliente, ms.unidade, man.data, man.numero';
        $resultado = DB::select($query);
        
        return $resultado;
    }
    
    private function ConsultaDespesaCliente(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $query = 'select '												
                .'  man.data as coleta, '
                .'  man.numero as manifesto, '
                .'  man.id_cliente, '
                .'  cli.razao_social as cliente, '
                .'  res.descricao as residuo, '
                .'  f1.nome_fantasia as transportador, '
                .'  f2.nome_fantasia as destinador, '
                .'  tt.descricao as tratamento,'
                .'  ms.quantidade as quantidade, '
                .'  ms.unidade as unidade, '
                .'  ms.quantidade * ccr1.preco_servico as valor_transporte,  '
                .'  ms.quantidade * ccr2.preco_servico as valor_destinacao, '
                .'  ((ms.quantidade * ccr1.preco_servico) + (ms.quantidade * ccr2.preco_servico)) as valor_total '
                .'from '
                .'  manifesto man '
                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto '
                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente '
                .'  left join contrato_cliente_residuo ccr1 on ccr1.id_contrato_cliente = man.id_contrato_cliente and ms.id_residuo = ccr1.id_residuo'
                .'  inner join servico s1 ON s1.id = ccr1.id_servico and s1.id_tipo_atividade = 1 '
                .'  left join contrato_cliente_residuo ccr2 on ccr2.id_contrato_cliente = man.id_contrato_cliente and ms.id_residuo = ccr2.id_residuo'
                .'  inner join servico s2 ON s2.id = ccr2.id_servico and s2.id_tipo_atividade = 2 '                
                .'  inner join cliente cli on cli.id = man.id_cliente '
                .'  inner join fornecedor f1 on f1.id = man.id_transportador '
                .'  inner join fornecedor f2 ON f2.id = man.id_destinador '
                .'  inner join residuo res on res.id = ms.id_residuo '
                .'  inner join tipo_tratamento tt on tt.id = ms.id_tratamento'
                .'  where ((ccr1.preco_servico > 0) or (ccr2.preco_servico > 0))';
                
                if ($request->has('id_cliente')) {
                    $query = $query.'  and man.id_cliente = ' . $request->input('id_cliente');                    
                }
                
                if ($request->has('id_manifesto')) {
                    $query = $query.'  and man.id = ' . $request->input('id_manifesto');
                }

                if ($request->has('datade')) {
                    $query = $query.'  and man.data >= date(' .$request->input('datade').')';
                }

                if ($request->has('dataate')) {
                    $query = $query.'  and man.data <= date(' .$request->input('dataate').')';
                }
                
                if ($request->has('id_residuo')) {
                    $query = $query.'  and res.id = ' . $request->input('id_residuo');
                }
                
                $query = $query.'  order by man.id_cliente, ms.unidade, man.data, man.numero';
        $resultado = DB::select($query);
        
        return $resultado;
    }
    
    private function ConsultaLocacoesCliente(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $query = 'select '												
                .'    l.data as coleta, '
                .'    l.id_cliente as id_cliente, '
                .'    c.razao_social as cliente, '
                .'    e.descricao as equipamento, '
                .'    le.quantidade as quantidade, '
                .'    le.unidade as unidade, '
                .'    cce.preco as valor_unitario, '
                .'    le.quantidade * cce.preco as valor_total '                             
                .'from '
                .'    locacao l '
                .'    inner join locacao_equipamento le on le.id_locacao = l.id'
                .'    inner join cliente c ON c.id = l.id_cliente'
                .'    inner join equipamento e ON e.id = le.id_equipamento'
                .'    inner join contrato_cliente cc ON cc.id = l.id_contrato_cliente'
                .'    inner join contrato_cliente_equipamento cce on cce.id_contrato_cliente = cc.id and le.id_equipamento = cce.id_equipamento '
                .'where cce.preco > 0';
                
                if ($request->has('id_cliente')) {
                    $query = $query.'  and l.id_cliente = ' . $request->input('id_cliente');                    
                }
                                
                if ($request->has('datade')) {
                    $query = $query.'  and l.data >= date(' .$request->input('datade').')';
                }

                if ($request->has('dataate')) {
                    $query = $query.'  and l.data <= date(' .$request->input('dataate').')';
                }                               
                
                $query = $query.'  order by l.id_cliente, le.unidade, l.data';
        $resultado = DB::select($query);
        
        return $resultado;
    }

    public function downloadExcel($type)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = Cliente::all();
        return Excel::create('clientes', function($excel) use ($data) {
                $excel->sheet('clientes', function($sheet) use ($data)
        {
                        $sheet->fromArray($data);
                        $sheet->row(1, function($row) {

                            // call cell manipulation methods
                            $row->setBackground('#000000');

                        });
        });
        })->download($type);
        
//        return Excel::create('New file', function($excel)
//                {
//                    $excel->sheet('New sheet', function($sheet)
//                    {
//                        $periodode = '01/01/2018';
//                        $periodoate = '31/12/2018';
//                        $clientes = Cliente::all();
//                        $sheet->loadView('relatorio.clientes',['clientes' => $clientes, 'periodode' => $periodode, 'periodoate' => $periodoate]);
//                    });
//                })->download($type);
    }

}
