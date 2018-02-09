<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Cliente;
use Illuminate\Support\Facades\Storage;
use JasperPHP\JasperPHP;

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
                public_path() . '/relatorios/clientes.jrxml', $output, ['pdf'], ['param_id'=>1], $this->getDatabaseConfig()
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
        
        // coloca na variavel o caminho do novo relatório que será gerado
        $output = public_path() . '/relatorios/' . time() . '_ReceitaCliente';
        // instancia um novo objeto JasperPHP

        $report = new JasperPHP;
        // chama o método que irá gerar o relatório
        // passamos por parametro:
        // o arquivo do relatório com seu caminho completo
        // o nome do arquivo que será gerado
        // o tipo de saída
        // parametros ( nesse caso não tem nenhum)         
        $report->process(
                public_path() . '/relatorios/receita_cliente.jasper', $output, ['pdf'], $arr, $this->getDatabaseConfig()
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
                        ->header('Content-Disposition', 'inline; filename="receita_cliente.pdf"');
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

    public function relcliente()
    {
        $clientes = Cliente::all();
        //return view('relatorio.clientes', ['clientes' => $clientes,]);
        $pdf = PDF::loadView('relatorio.clientes', ['clientes' => $clientes,]);
//        return $pdf->download('clientes.pdf');
        return $pdf->setPaper('a4', 'landscape')->save(public_path() . '/relatorios/my_stored_file.pdf')->stream();
    }

}
