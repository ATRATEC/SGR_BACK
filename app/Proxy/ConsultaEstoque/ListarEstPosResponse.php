<?php

namespace App\Proxy\ConsultaEstoque;

/**
 * Resposta da solicitação da listagem de posição de estoque.
 *
 * @pw_element integer $nPagina Número da página retornada.
 * @pw_element integer $nTotPaginas Número total de páginas.
 * @pw_element integer $nRegistros Número de registros retornados na página.
 * @pw_element integer $nTotRegistros total de registros encontrados.
 * @pw_element string $dDataPosicao Data da posição do estoque.
 * @pw_element produtosArray $produtos Lista a posição do estoque dos produtos encontrados.
 * @pw_complex ListarEstPosResponse
 */
class ListarEstPosResponse{
	/**
	 * Número da página retornada.
	 *
	 * @var integer
	 */
	public $nPagina;
	/**
	 * Número total de páginas.
	 *
	 * @var integer
	 */
	public $nTotPaginas;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $nRegistros;
	/**
	 * total de registros encontrados.
	 *
	 * @var integer
	 */
	public $nTotRegistros;
	/**
	 * Data da posição do estoque.
	 *
	 * @var string
	 */
	public $dDataPosicao;
	/**
	 * Lista a posição do estoque dos produtos encontrados.
	 *
	 * @var produtosArray
	 */
	public $produtos;
}
