<?php

namespace App\Proxy\ConsultaEstoque;

/**
 * Consulta Movimento de Estoque de um Produto
 *
 * @pw_element integer $id_prod Código do Produto
 * @pw_element string $cod_int Código de Integração do Produto
 * @pw_element string $dataInicial Data Inicial de Consulta de Estoque
 * @pw_element string $dataFinal Data Final da Consulta de Estoque
 * @pw_complex estoqueMovimentoRequest
 */
class estoqueMovimentoRequest{
	/**
	 * Código do Produto
	 *
	 * @var integer
	 */
	public $id_prod;
	/**
	 * Código de Integração do Produto
	 *
	 * @var string
	 */
	public $cod_int;
	/**
	 * Data Inicial de Consulta de Estoque
	 *
	 * @var string
	 */
	public $dataInicial;
	/**
	 * Data Final da Consulta de Estoque
	 *
	 * @var string
	 */
	public $dataFinal;
}
