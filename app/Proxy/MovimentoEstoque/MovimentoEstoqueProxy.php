<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Proxy\MovimentoEstoque;

/**
 * Description of MovimentoEstoque
 *
 * @author atxal
 */
class MovimentoEstoqueProxy {
    /**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/estoque/movestoque/?WSDL';
	/**
	 * The PHP SoapClient object
	 *
	 * @var object
	 */
	public static $_Server=null;
	/**
	 * The endpoint URI
	 *
	 * @var string
	 */
	public static $_EndPoint='http://app.omie.com.br/api/v1/estoque/movestoque/';

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
	public static function _Call($method,$param){
		$call=Array(
			"call"=>$method,
			"param"=>$param,
			"app_key"=>'1142656109',
			"app_secret"=>'66b2a456a2c92eaf9646bc95587d47f0'
		);
		return json_decode(file_get_contents(self::$_EndPoint."?JSON=".urlencode(json_encode($call))));
	}

	/**
	 * Lista os movimentos de entrada/saida de um período.
	 *
	 * @param epListarRequest $epListarRequest Solicitação da listagem movimentos de estoque de entrada/saida de um período.
	 * @return epListarResponse Resposta da solicitação da listagem movimentos de estoque de entrada/saida de um período.
	 */
	public function ListarMovimentos($epListarRequest){
		return self::_Call('ListarMovimentos',Array(
			$epListarRequest
		));
	}

	/**
	 * Consulta a previsão de venda em estoque de um produto.
	 *
	 * @param epPrevisaoRequest $epPrevisaoRequest Previsão de estoque do produto.
	 * @return epPrevisaoResponse Previsão de estoque do produto.
	 */
	public function ConsultarPrevisao($epPrevisaoRequest){
		return self::_Call('ConsultarPrevisao',Array(
			$epPrevisaoRequest
		));
	}
}
