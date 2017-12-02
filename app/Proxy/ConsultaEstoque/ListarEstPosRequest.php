<?php

namespace App\Proxy\ConsultaEstoque;

/**
 * Solicitação da listagem da posição do estoque.
 *
 * @pw_element integer $nPagina Número da página retornada.
 * @pw_element integer $nRegPorPagina Número de registros retornados na página.
 * @pw_element string $dDataPosicao Data da posição do estoque.
 * @pw_element string $cExibeTodos Exibir todos os produtos mesmo que não haja movimento.<BR>Padrão: "N"
 * @pw_complex ListarEstPosRequest
 */
class ListarEstPosRequest{
	/**
	 * Número da página retornada.
	 *
	 * @var integer
	 */
	public $nPagina;
	/**
	 * Número de registros retornados na página.
	 *
	 * @var integer
	 */
	public $nRegPorPagina;
	/**
	 * Data da posição do estoque.
	 *
	 * @var string
	 */
	public $dDataPosicao;
	/**
	 * Exibir todos os produtos mesmo que não haja movimento.<BR>Padrão: "N"
	 *
	 * @var string
	 */
	public $cExibeTodos;
}
