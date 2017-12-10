<?php

namespace App\Proxy\ConsultaEstoque;

/**
 * Status de Resposta da Consulta de Estoque
 *
 * @pw_element string $codigo_status Código de Resposta do Status da Consulta de Estoque
 * @pw_element string $descricao_status Descrição de Resposta do Status da Consulta de Estoque
 * @pw_element decimal $saldo Saldo de Estoque da Consulta
 * @pw_element decimal $cmc Valor do CMC da Consulta de Estoque
 * @pw_complex estoque_mov_consulta_cadastro_resposta
 */
class estoque_mov_consulta_cadastro_resposta{
	/**
	 * Código de Resposta do Status da Consulta de Estoque
	 *
	 * @var string
	 */
	public $codigo_status;
	/**
	 * Descrição de Resposta do Status da Consulta de Estoque
	 *
	 * @var string
	 */
	public $descricao_status;
	/**
	 * Saldo de Estoque da Consulta
	 *
	 * @var decimal
	 */
	public $saldo;
	/**
	 * Valor do CMC da Consulta de Estoque
	 *
	 * @var decimal
	 */
	public $cmc;
}
