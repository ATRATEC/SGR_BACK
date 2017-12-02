<?php

namespace App\Proxy\ConsultaEstoque;

class ConsultaEstoqueProxy {
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://app.omie.com.br/api/v1/estoque/consulta/?WSDL';
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
	public static $_EndPoint='http://app.omie.com.br/api/v1/estoque/consulta/';

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
	 * Obtém a Posição de Estoque de um determinado produto para a data
	 *
	 * @param estoque_mov_consulta_cadastro $estoque_mov_consulta_cadastro Registro de Consulta de Estoque
	 * @return estoque_mov_consulta_cadastro_resposta Status de Resposta da Consulta de Estoque
	 */
	public function PosicaoEstoque($estoque_mov_consulta_cadastro){
		return self::_Call('PosicaoEstoque',Array(
			$estoque_mov_consulta_cadastro
		));
	}

	/**
	 * Consulta do Movimento de Estoque
	 *
	 * @param estoqueMovimentoRequest $estoqueMovimentoRequest Consulta Movimento de Estoque de um Produto
	 * @return estoqueMovimentoResponse Resposta do consulta de movimentação do Estoque
	 */
	public function MovimentoEstoque($estoqueMovimentoRequest){
		return self::_Call('MovimentoEstoque',Array(
			$estoqueMovimentoRequest
		));
	}

	/**
	 * Lista as posições de estoque de um dia.
	 *
	 * @param ListarEstPosRequest $ListarEstPosRequest Solicitação da listagem da posição do estoque.
	 * @return ListarEstPosResponse Resposta da solicitação da listagem de posição de estoque.
	 */
	public function ListarPosEstoque($ListarEstPosRequest){
		return self::_Call('ListarPosEstoque',Array(
			$ListarEstPosRequest
		));
	}
}
