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
use PHPExcel_Worksheet_Drawing;
use PDO;

class RelatoriosController extends Controller
{
        
    public function receita(Request $request)
    {
        $lista = $this->ConsultaReceita($request);
        
        return response()->json($lista, 200);
    }
    
    public function receitaClasse(Request $request)
    {
        $lista = $this->ConsultaReceitaClasse($request);
        
        return response()->json($lista, 200);
    }
    
    public function receitaSintetica(Request $request)
    {
        $lista = $this->ConsultaReceitaSintetica($request);
        
        return response()->json($lista, 200);
    }
    
    public function receitaClasseSintetica(Request $request)
    {
        $lista = $this->ConsultaReceitaClasseSintetica($request);
        
        return response()->json($lista, 200);
    }
    
    public function despesaavcli(Request $request)
    {
        $lista = $this->ConsultaDespesa($request);
        
        return response()->json($lista, 200);
    }
    
    public function despesaavfor(Request $request)
    {
        $lista = $this->ConsultaDespesaFor($request);
        
        return response()->json($lista, 200);
    }
    
    public function despesaAvCliSintetica(Request $request)
    {
        $lista = $this->ConsultaDespesaSintetica($request);
        
        return response()->json($lista, 200);
    }
    
    public function despesaAvForSintetica(Request $request)
    {
        $lista = $this->ConsultaDespesaForSintetica($request);
        
        return response()->json($lista, 200);
    }

    public function receitaCliente(Request $request)
    {
        $lista = $this->ConsultaReceitaCliente($request);
        
        return response()->json($lista, 200);
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
    
    public function pesagens(Request $request)
    {
        $lista = $this->ConsultaPesagens($request);
        
        return response()->json($lista, 200);
    }
    
    public function mapaResiduos(Request $request)
    {
        $lista = $this->ConsultaMapaResiduo($request);
        
        return response()->json($lista, 200);
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
    
    private function ConsultaPesagens(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $query = 'select '												
                .'    p.data as coleta, '
                .'    p.id_cliente as id_cliente, '
                .'    c.razao_social as cliente, '
                .'    r.descricao as residuo, '                
                .'    ip.unidade as unidade, '                
                .'    ip.peso as peso '                             
                .'from '
                .'    pesagem p '
                .'    inner join item_pesagem ip on ip.id_pesagem = p.id'
                .'    inner join cliente c ON c.id = p.id_cliente'
                .'    inner join residuo r ON r.id = ip.id_residuo '                
                .'where ip.peso > 0 ';
                
                if ($request->has('id_cliente')) {
                    $query = $query.'  and p.id_cliente = ' . $request->input('id_cliente');                    
                }
                
                if ($request->has('id_residuo')) {
                    $query = $query.'  and r.id = ' . $request->input('id_residuo');
                }
                                
                if ($request->has('datade')) {
                    $query = $query.'  and p.data >= date(' .$request->input('datade').')';
                }

                if ($request->has('dataate')) {
                    $query = $query.'  and p.data <= date(' .$request->input('dataate').')';
                }                               
                
                $query = $query.'  order by p.id_cliente, ip.unidade, p.data';
        $resultado = DB::select($query);
        
        return $resultado;
    }
    
    // <editor-fold desc="Metodos de consulta analiticos">  
    
    private function ConsultaReceita(Request $request)
    {        
        $query = 'select '	
                .'  man.data as coleta, '
                .'  man.numero as manifesto, '
                .'  man.id_cliente, '
                .'  cli.razao_social as cliente, '
                .'  res.descricao as residuo, '
                .'  cr.id as id_classe, '
                .'  cr.descricao as classe, '
                .'  f1.nome_fantasia as transportador, '
                .'  f2.nome_fantasia as destinador, '
                .'  tt.descricao as tratamento, '
                .'  ms.quantidade as quantidade, '
                .'  ms.unidade as unidade, '
                .'  ccr.preco_venda as valor_unitario, '
                .'  ms.quantidade * ccr.preco_venda as valor_total '
                .'from '
                .'  manifesto man '
                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto  '
                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente '
                .'  inner join ( '
                .'	SELECT '
                .'  	ccrg.id_contrato_cliente, '
                .'  	cfrg.id_residuo, '
                .'  	cfrg.unidade, '
                .'  	sum(cfrg.preco_venda) as preco_venda '
                .'	FROM '
                .'  	contrato_fornecedor_residuo cfrg '
                .'  	INNER JOIN contrato_cliente_residuo ccrg on cfrg.id_residuo = ccrg.id_residuo '
                .'  	and cfrg.id_servico = ccrg.id_servico '
                .'  	and cfrg.unidade = ccrg.unidade '
                .'  	and cfrg.id_contrato = ccrg.id_contrato_fornecedor '
                .'	GROUP BY ccrg.id_contrato_cliente, cfrg.id_residuo, cfrg.unidade '
                .'    ) ccr '
                .'  on (ccr.id_contrato_cliente = cc.id and ms.id_residuo = ccr.id_residuo and ms.unidade = ccr.unidade) '
                .'  inner join cliente cli on cli.id = man.id_cliente '
                .'  inner join fornecedor f1 on f1.id = man.id_transportador '
                .'  inner join fornecedor f2 ON f2.id = man.id_destinador '
                .'  inner join residuo res on res.id = ms.id_residuo '
                .'  inner join tipo_tratamento tt on tt.id = ms.id_tratamento '
                .'  inner join classe_residuo cr ON cr.id = res.id_classe '
                .'where ccr.preco_venda > 0 ';
                
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
            
    private function ConsultaReceitaClasse(Request $request)
    {        
        $query = 'select'									
                .'  man.data as coleta, '
                .'  man.numero as manifesto, '
                .'  man.id_cliente, '
                .'  cli.razao_social as cliente, '
                .'  res.descricao as residuo, '
                .'  cr.id as id_classe, '
                .'  cr.descricao as classe, '
                .'  f1.nome_fantasia as transportador, '
                .'  f2.nome_fantasia as destinador, '
                .'  tt.descricao as tratamento, '
                .'  ms.quantidade as quantidade, '
                .'  ms.unidade as unidade, '
                .'  ccr.preco_servico as valor_unitario, '
                .'  ms.quantidade * ccr.preco_servico as valor_total '
                .'from '
                .'  manifesto man '
                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto '
                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente '
                .'  inner join ( '
                .'	select '
                .'		ccrg.id_contrato_cliente, '
                .'		ccrg.id_contrato_fornecedor, '
                .'		ccrg.id_residuo, '                
                .'		sum(ccrg.preco_servico) as preco_servico '
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
                .'  inner join tipo_tratamento tt on tt.id = ms.id_tratamento '
                .'  inner join classe_residuo cr ON cr.id = res.id_classe '
                .'  where ccr.preco_servico > 0 ';
                
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

                
                $query = $query.'  order by cr.id, man.id_cliente, ms.unidade, man.data, man.numero';
        $resultado = DB::select($query);
        
        return $resultado;
    }
    
    private function ConsultaDespesa(Request $request)
    {        
        $query = 'select                                                                   '
                .'  man.data as coleta,                                                    '
                .'  man.numero as manifesto,                                               '
                .'  man.id_cliente,                                                        '
                .'  cli.razao_social as cliente,                                           '
                .'  res.descricao as residuo,                                              '
                .'  f1.nome_fantasia as transportador,                                     '
                .'  f2.nome_fantasia as destinador,                                        '
                .'  ms.quantidade as quantidade,                                           '
                .'  ms.unidade as unidade,                                                 '
                .'  ccr.preco_compra as valor_unitario,                                    '
                .'  ms.quantidade * ccr.preco_compra as valor_total                        '
                .'from                                                                     '
                .'  manifesto man                                                          '
                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto            '
                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente      '
                .'  inner join (                                                           '
                .'		select                                                     '
                .'			ccrg.id_contrato_cliente,                          '                
                .'			ccrg.id_residuo,                                   '
                .'			sum(ccrg.preco_compra) as preco_compra             '
                .'		from                                                       '
                .'			contrato_cliente_residuo ccrg                      '
                .'		group by                                                   '
                .'			ccrg.id_contrato_cliente,                          '
                .'			ccrg.id_residuo) ccr                               '
                .'  on (ccr.id_contrato_cliente = cc.id and ms.id_residuo = ccr.id_residuo)'
                .'  inner join cliente cli on cli.id = man.id_cliente                      '
                .'  inner join fornecedor f1 on f1.id = man.id_transportador               '
                .'  inner join fornecedor f2 ON f2.id = man.id_destinador                  '
                .'  inner join residuo res on res.id = ms.id_residuo                       '
                .'  where ccr.preco_compra > 0                                             ';
                                 
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
    
    private function ConsultaDespesaFor(Request $request)
    {        
        $query = 'select															   '										
                .'  man.data as coleta,                                                '
                .'  man.numero as manifesto,                                           '
                .'  forn.id as id_fornecedor,                                          '
                .'  forn.cnpj_cpf as cnpj_cpf,                                         '
                .'  forn.razao_social as fornecedor,                                   '
                .'  res.descricao as residuo,                                          '
                .'  cr.id as id_classe,                                                '
                .'  cr.descricao as classe,                                            '
                .'  ser.id as id_servico,                                              '
                .'  ser.descricao as servico,                                          '
                .'  ms.quantidade as quantidade,                                       '
                .'  ms.unidade as unidade,                                             '
                .'  cfr.preco_servico as valor_unitario,                               '
                .'  ms.quantidade * cfr.preco_servico as valor_total                   '
                .'from                                                                 '
                .'  manifesto man                                                      '
                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto        '
                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente  '
                .'  inner join contrato_cliente_residuo ccr                            '
                .'	on (ccr.id_contrato_cliente = cc.id                            '
                .'	and ccr.id_residuo = ms.id_residuo)                            '
                .'  inner join contrato_fornecedor_residuo cfr                         '
                .'	on (cfr.id_contrato = ccr.id_contrato_fornecedor               '
                .'	and cfr.id_residuo = ccr.id_residuo                            '
                .'	and cfr.id_servico = ccr.id_servico)                           '
                .'  inner join cliente cli on cli.id = man.id_cliente                  '
                .'  inner join fornecedor forn on forn.id = cfr.id_fornecedor          '
                .'  inner join residuo res on res.id = ms.id_residuo                   '
                .'  inner join servico ser ON ser.id = ccr.id_servico                  '
                .'  inner join tipo_tratamento tt on tt.id = ms.id_tratamento          '
                .'  inner join classe_residuo cr ON cr.id = res.id_classe              '
                .'  where cfr.preco_servico > 0                                        ';
//.'  order by man.data, man.numero, forn.razao_social                   ';
                                 
        if ($request->has('id_cliente')) {
            $query = $query.'  and man.id_cliente = ' . $request->input('id_cliente');                    
        }

        if ($request->has('id_manifesto')) {
            $query = $query.'  and man.id = ' . $request->input('id_manifesto');
        }
        
        if ($request->has('id_fornecedor')) {
            $query = $query.'  and forn.id = ' . $request->input('id_fornecedor');
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
                
        $query = $query.'  order by forn.razao_social, ms.unidade, man.data, man.numero, cr.id';
        $resultado = DB::select($query);
        
        return $resultado;
    }
    
    // </editor-fold>
    // <editor-fold desc="Metodos de consulta sinteticos">  
    private function ConsultaReceitaSintetica(Request $request)
    {        
        $query = 'select destinador as credor, cnpj_cpf, GROUP_CONCAT(manifesto) as manifestos, sum(valor_total) as total from '  
                .'(select '	
                .'  man.data as coleta, '
                .'  concat(" ",man.numero) as manifesto, '
                .'  man.id_cliente, '
                .'  cli.razao_social as cliente, '
                .'  res.descricao as residuo, '
                .'  cr.id as id_classe, '
                .'  cr.descricao as classe, '
                .'  f1.nome_fantasia as transportador, '
                .'  f2.cnpj_cpf as cnpj_cpf, '
                .'  f2.razao_social as destinador, '
                .'  tt.descricao as tratamento, '
                .'  ms.quantidade as quantidade, '
                .'  ms.unidade as unidade, '
                .'  ccr.preco_venda as valor_unitario, '
                .'  ms.quantidade * ccr.preco_venda as valor_total '
                .'from '
                .'  manifesto man '
                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto  '
                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente '
                .'  inner join ( '
                .'	SELECT '
                .'  	ccrg.id_contrato_cliente, '
                .'  	cfrg.id_residuo, '
                .'  	cfrg.unidade, '
                .'  	sum(cfrg.preco_venda) as preco_venda '
                .'	FROM '
                .'  	contrato_fornecedor_residuo cfrg '
                .'  	INNER JOIN contrato_cliente_residuo ccrg on cfrg.id_residuo = ccrg.id_residuo '
                .'  	and cfrg.id_servico = ccrg.id_servico '
                .'  	and cfrg.unidade = ccrg.unidade '
                .'  	and cfrg.id_contrato = ccrg.id_contrato_fornecedor '
                .'	GROUP BY ccrg.id_contrato_cliente, cfrg.id_residuo, cfrg.unidade '
                .'    ) ccr '
                .'  on (ccr.id_contrato_cliente = cc.id and ms.id_residuo = ccr.id_residuo and ms.unidade = ccr.unidade) '
                .'  inner join cliente cli on cli.id = man.id_cliente '
                .'  inner join fornecedor f1 on f1.id = man.id_transportador '
                .'  inner join fornecedor f2 ON f2.id = man.id_destinador '
                .'  inner join residuo res on res.id = ms.id_residuo '
                .'  inner join tipo_tratamento tt on tt.id = ms.id_tratamento '
                .'  inner join classe_residuo cr ON cr.id = res.id_classe '
                .'where ccr.preco_venda > 0 ';
                
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

                
                $query = $query.') consulta ';
                $query = $query.'group by destinador, cnpj_cpf';
        $resultado = DB::select($query);
        
        return $resultado;
    }
    
    private function ConsultaReceitaClasseSintetica(Request $request)
    {        
        $query = 'select cliente as credor, cnpj_cpf, GROUP_CONCAT(manifesto) as  manifestos, sum(valor_total) as total from'
                .'(select'									
                .'  man.data as coleta, '
                .'  concat(" ",man.numero) as manifesto, '
                .'  man.id_cliente, '
                .'  cli.cnpj_cpf as cnpj_cpf, '
                .'  cli.razao_social as cliente, '
                .'  res.descricao as residuo, '
                .'  cr.id as id_classe, '
                .'  cr.descricao as classe, '
                .'  f1.nome_fantasia as transportador, '
                .'  f2.nome_fantasia as destinador, '
                .'  tt.descricao as tratamento, '
                .'  ms.quantidade as quantidade, '
                .'  ms.unidade as unidade, '
                .'  ccr.preco_servico as valor_unitario, '
                .'  ms.quantidade * ccr.preco_servico as valor_total '
                .'from '
                .'  manifesto man '
                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto '
                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente '
                .'  inner join ( '
                .'	select '
                .'		ccrg.id_contrato_cliente, '
                .'		ccrg.id_contrato_fornecedor, '
                .'		ccrg.id_residuo, '                
                .'		sum(ccrg.preco_servico) as preco_servico '
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
                .'  inner join tipo_tratamento tt on tt.id = ms.id_tratamento '
                .'  inner join classe_residuo cr ON cr.id = res.id_classe '
                .'  where ccr.preco_servico > 0 ';
                
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

                
                $query = $query.') consulta ';
                $query = $query.'group by cliente, cnpj_cpf';
        $resultado = DB::select($query);
        
        return $resultado;
    }
    
    private function ConsultaDespesaSintetica(Request $request)
    {        
        $query = 'select cnpj_cpf, Cliente as credor,"Compra de Resíduo" as servico, GROUP_CONCAT(Manifesto) as manifestos, sum(Total) as total from'
                .'(select                                                                  '
                .'  cli.cnpj_cpf as cnpj_cpf,                                              '
                .'  man.data as Data_Coleta,                                               '
                .'  concat(" ",man.numero) as Manifesto,                                   '
                .'  man.id_cliente,                                                        '
                .'  cli.razao_social as Cliente,                                           '
                .'  res.descricao as Residuo,                                              '
                .'  f1.nome_fantasia as Transportador,                                     '
                .'  f2.nome_fantasia as Destinador,                                        '
                .'  ms.quantidade as Qtd,                                                  '
                .'  ms.unidade as Und,                                                     '
                .'  ccr.preco_compra as ValUnit,                                           '
                .'  ms.quantidade * ccr.preco_compra as Total                              '
                .'from                                                                     '
                .'  manifesto man                                                          '
                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto            '
                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente      '
                .'  inner join (                                                           '
                .'		select                                                     '
                .'			ccrg.id_contrato_cliente,                          '                
                .'			ccrg.id_residuo,                                   '
                .'			sum(ccrg.preco_compra) as preco_compra             '
                .'		from                                                       '
                .'			contrato_cliente_residuo ccrg                      '
                .'		group by                                                   '
                .'			ccrg.id_contrato_cliente,                          '
                .'			ccrg.id_residuo) ccr                               '
                .'  on (ccr.id_contrato_cliente = cc.id and ms.id_residuo = ccr.id_residuo)'
                .'  inner join cliente cli on cli.id = man.id_cliente                      '
                .'  inner join fornecedor f1 on f1.id = man.id_transportador               '
                .'  inner join fornecedor f2 ON f2.id = man.id_destinador                  '
                .'  inner join residuo res on res.id = ms.id_residuo                       '
                .'  where ccr.preco_compra > 0                                             ';
                                 
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
                
        $query = $query.') consulta ';
        $query = $query.'group by cnpj_cpf, Cliente';
        $resultado = DB::select($query);
        
        return $resultado;
    }
    
    private function ConsultaDespesaForSintetica(Request $request)
    {        
        $query = 'select cnpj_cpf, fornecedor as credor,servico, GROUP_CONCAT(manifesto) as manifestos, sum(valor_total) as total from '
                .'(select															   '										
                .'  man.data as coleta,                                                '
                .'  man.numero as manifesto,                                           '
                .'  forn.id as id_fornecedor,                                          '
                .'  forn.cnpj_cpf as cnpj_cpf,                                         '
                .'  forn.razao_social as fornecedor,                                   '
                .'  res.descricao as residuo,                                          '
                .'  cr.descricao as classe,                                            '
                .'  ser.id as id_servico,                                              '
                .'  ser.descricao as servico,                                          '
                .'  ms.quantidade as quantidade,                                       '
                .'  ms.unidade as unidade,                                             '
                .'  cfr.preco_servico as valor_unitario,                               '
                .'  ms.quantidade * cfr.preco_servico as valor_total                   '
                .'from                                                                 '
                .'  manifesto man                                                      '
                .'  inner join manifesto_servico ms on man.id = ms.id_manifesto        '
                .'  inner join contrato_cliente cc ON cc.id = man.id_contrato_cliente  '
                .'  inner join contrato_cliente_residuo ccr                            '
                .'	on (ccr.id_contrato_cliente = cc.id                            '
                .'	and ccr.id_residuo = ms.id_residuo)                            '
                .'  inner join contrato_fornecedor_residuo cfr                         '
                .'	on (cfr.id_contrato = ccr.id_contrato_fornecedor               '
                .'	and cfr.id_residuo = ccr.id_residuo                            '
                .'	and cfr.id_servico = ccr.id_servico)                           '
                .'  inner join cliente cli on cli.id = man.id_cliente                  '
                .'  inner join fornecedor forn on forn.id = cfr.id_fornecedor          '
                .'  inner join residuo res on res.id = ms.id_residuo                   '
                .'  inner join servico ser ON ser.id = ccr.id_servico                  '
                .'  inner join tipo_tratamento tt on tt.id = ms.id_tratamento          '
                .'  inner join classe_residuo cr ON cr.id = res.id_classe              '
                .'  where cfr.preco_servico > 0                                        ';
//.'  order by man.data, man.numero, forn.razao_social                   ';
                                 
        if ($request->has('id_cliente')) {
            $query = $query.'  and man.id_cliente = ' . $request->input('id_cliente');                    
        }

        if ($request->has('id_manifesto')) {
            $query = $query.'  and man.id = ' . $request->input('id_manifesto');
        }
        
        if ($request->has('id_fornecedor')) {
            $query = $query.'  and forn.id = ' . $request->input('id_fornecedor');
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
                
        $query = $query.' ) consulta ';
        $query = $query.' group by cnpj_cpf, fornecedor, servico';
        $resultado = DB::select($query);
        
        return $resultado;
    }
    
    private function ConsultaMapaResiduo(Request $request)
    {        
        $query = 'select distinct                                                    '	                
                .'  r.descricao as residuo,                                          '
                .'  ac.descricao as acondicionamento,                                '
                .'  tr.descricao as tipo_residuo,                                    '
                .'  r.codigo_nbr as codigo_nbr,                                      '
                .'  cr.descricao as classe,                                          '
                .'  r.codigo_onu as codigo_onu,                                      '                                
                .'  f1.nome_fantasia as transportador,                               '
                .'  f2.nome_fantasia as destinador,                                  '
                .'  tt.descricao as tipo_tratamento                                  '
                .'from                                                               '
                .'  manifesto m                                                      '
                .'  inner join manifesto_servico ms on m.id = ms.id                  '
                .'  inner join residuo r on ms.id_residuo = r.id                     '
                .'  inner join acondicionamento ac ON ac.id = ms.id_acondicionamento '
                .'  inner join tipo_residuo tr ON tr.id = ms.id_tipo_residuo         '
                .'  inner join classe_residuo cr ON cr.id = r.id_classe              '
                .'  inner join fornecedor f1 on f1.id = m.id_transportador           '
                .'  inner join fornecedor f2 on f2.id = m.id_destinador              '
                .'  inner join tipo_tratamento tt ON tt.id = ms.id_tratamento        '
                .'where r.descricao is not null ';
//.'  order by man.data, man.numero, forn.razao_social                   ';
                                 
        if ($request->has('id_cliente')) {
            $query = $query.'  and m.id_cliente = ' . $request->input('id_cliente');                    
        }
        
        if ($request->has('datade')) {
            $query = $query.'  and m.data >= date(' .$request->input('datade').')';
        }

        if ($request->has('dataate')) {
            $query = $query.'  and m.data <= date(' .$request->input('dataate').')';
        }
        
        $query = $query.' order by r.descricao asc ';
        
        $resultado = DB::select($query);
        
        return $resultado;
    }
    // </editor-fold>
    
    public function downloadMapaResiduo(Request $request)
    {
        $type = 'xlsx';
        $cliente = Cliente::find($request->input('id_cliente'));
        
        $data = json_decode(json_encode($this->ConsultaMapaResiduo($request)), true);
        
        $head = array(
            'IDENTIFICAÇÃO DO RESÍDUO',
            'ACONDICIONAMENTO',
            'ESTADO FÍSICO',
            'CÓDIGO',
            'CLASSE',
            'N° ONU',
            'TRANSPORTADOR',
            'DESTINADOR',	
            'TRATAMENTO REALIZADO'
        );
//        return response()->json($data, 200);
        
        return Excel::create('MAPA_RESIDUO', function($excel) use ($data, $head, $cliente)  
        {
            $excel->sheet('clientes', function($sheet) use ($data, $head, $cliente) 
            {
                $rowcount = count($data) + 3;

                // $sheet->fromArray($head, null, 'A2', false, false);
                $sheet->setAllBorders('medium');
                $sheet->fromModel($data, null, 'A3', false, false);
                $sheet->prependRow(3, $head);

                // Imagem do cabeçalho
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('/assets/imagens/logo_av_small.png')); //your image path
                $objDrawing->setOffsetX(5);                       //setOffsetX works properly
                $objDrawing->setOffsetY(5); 
                $objDrawing->setCoordinates('A1');
                $objDrawing->setWorksheet($sheet);

                //definindo tamanha da primeira linha (logo + titulo)
                $sheet->setHeight(1, 50);
                //definindo tamanha da terceira linha (cabeçalho de colunas)
                $sheet->setHeight(3, 20);
                //congelando celulas
                $sheet->setFreeze('A1');
                $sheet->setFreeze('A2');
                $sheet->setFreeze('A3');
                $sheet->setFreeze('A4');

                $sheet->mergeCells('A1:B1');
                $sheet->mergeCells('A2:B2');
                $sheet->mergeCells('C1:I2');

                $sheet->setBorder('A1:I'.$rowcount, 'thin');
                $sheet->cell('C1', function($cell) {

                    // manipulate the cell
                    $cell->setValue('MAPA DE GERENCIAMENTO DE RESÍDUOS');
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                    $cell->setFontColor('#ffffff');
                    $cell->setBackground('#6B8E23');
                    $cell->setFontSize(16);
                    $cell->setFontWeight('bold');

                });

                $sheet->cell('A2', function($cell) use ($cliente) {
                    
                    $cell->setValue('CLIENTE: '. $cliente->nome_fantasia);                    
                    $cell->setFontWeight('bold');

                });

                $sheet->row(3, function($row) {

                    // call cell manipulation methods
                    $row->setBackground('#8FBC8F');
                    $row->setFontWeight('bold');

                });
            });
        })->download($type);
        
    }

    public function downloadExcel($type)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = Cliente::all();
        $head = array(
            'ID',
            'CODIGO_OMIE',
            'CODIGO_INTEGRACAO',
            'CNPJ_CPF',
            'RAZAO_SOCIAL',
            'NOME_FANTASIA',
            'LOGRADOURO',
            'ENDERECO',	
            'ENDERECO_NUMERO',	
            'COMPLEMENTO',
            'BAIRRO',
            'CIDADE',
            'ESTADO',
            'CEP',
            'CODIGO_PAIS',
            'NASCIMENTO',
            'CONTATO',
            'TELEFONE1_DDD',
            'TELEFONE1_NUMERO',
            'TELEFONE2_DDD',
            'TELEFONE2_NUMERO',
            'FAX_DDD',
            'FAX_NUMERO',
            'EMAIL',
            'HOMEPAGE',
            'OBSERVACAO',
            'INSCRICAO_MUNICIPAL',
            'INSCRICAO_ESTADUAL',
            'INSCRICAO_SUFRAMA',
            'PESSOA_FISICA',
            'OPTANTE_SIMPLES_NACIONAL',
            'BLOQUEADO',
            'IMPORTADO_API',
            'CNAE',
            'OBSENDERECO',
            'OBSTELEFONESEMAIL',
            'INATIVO',
            'INCLUSAO',
            'USUARIO_INCLUSAO',
            'ALTERACAO',
            'USUARIO_ALTERACAO',
            'SINCRONIZAR',
            'ID_EMPRESA',
            'ID_FILIAL',
            'CREATED_AT',
            'UPDATED_AT'
    );
        return Excel::create('clientes', function($excel) use ($data, $head)  {
                $excel->sheet('clientes', function($sheet) use ($data, $head) 
        {
                        // $sheet->fromArray($head, null, 'A2', false, false);
                        $sheet->fromArray($data, null, 'A3', false, false);
                        $sheet->prependRow(3, $head);
                        
                        $objDrawing = new PHPExcel_Worksheet_Drawing;
                        $objDrawing->setPath(public_path('/assets/imagens/logo_av_small.png')); //your image path
                        $objDrawing->setOffsetX(5);                       //setOffsetX works properly
                        $objDrawing->setOffsetY(5); 
//
//                        $objDrawing->setWidth(224);
//                        $objDrawing->setHeight(52);
                        $objDrawing->setCoordinates('A1');
                        $objDrawing->setWorksheet($sheet);
                        
                        //definindo tamanha da primeira linha
                        $sheet->setHeight(1, 50);
                        //congelando celulas
                        $sheet->setFreeze('A1');
                        $sheet->setFreeze('A2');
                        $sheet->setFreeze('A3');
                        $sheet->setFreeze('A4');
                        
//                        $sheet->row(1, function($row) {
//
//                            // call cell manipulation methods
//                            $row->setBackground('#000000');
//
//                        });
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
