<?php

namespace App\Proxy\MovimentoEstoque;

/**
 * Solicitação da listagem movimentos de estoque de entrada/saida de um período.
 *
 * @pw_element integer $pagina Número da página retornada
 * @pw_element integer $registros_por_pagina Número de registros retornados na página.
 * @pw_element string $apenas_importado_api Exibir apenas os registros gerados pela API
 * @pw_element string $ordenar_por Ordem de exibição dos dados. Padrão: Código.
 * @pw_element string $ordem_decrescente Se a lista será apresentada em ordem decrescente.
 * @pw_element string $data_inicial Data de inicio do período a ser pesquisado.
 * @pw_element string $data_final Data final do período a ser pesquisado.
 * @pw_complex epListarRequest
 */
class epListarRequest{
	/**
	 * Número da página retornada
	 *
	 * @var integer
	 */
	public $pagina;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $registros_por_pagina;
	/**
	 * Exibir apenas os registros gerados pela API
	 *
	 * @var string
	 */
	public $apenas_importado_api;
	/**
	 * Ordem de exibição dos dados. Padrão: Código.
	 *
	 * @var string
	 */
	public $ordenar_por;
	/**
	 * Se a lista será apresentada em ordem decrescente.
	 *
	 * @var string
	 */
	public $ordem_decrescente;
	/**
	 * Data de inicio do período a ser pesquisado.
	 *
	 * @var string
	 */
	public $data_inicial;
	/**
	 * Data final do período a ser pesquisado.
	 *
	 * @var string
	 */
	public $data_final;
}
