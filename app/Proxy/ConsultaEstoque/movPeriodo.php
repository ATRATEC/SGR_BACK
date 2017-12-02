<?php

namespace App\Proxy\ConsultaEstoque;

/**
 * Movimentação no período.
 *
 * @pw_element string $tipo tipo do lançamento (Anterior,Entrada,Saída,Atual)
 * @pw_element decimal $qtde Quantidade
 * @pw_element decimal $cmcUnitario Custo Médio Contábil.
 * @pw_element decimal $cmcTotal CMC Total
 * @pw_complex movPeriodo
 */
class movPeriodo{
	/**
	 * tipo do lançamento (Anterior,Entrada,Saída,Atual)
	 *
	 * @var string
	 */
	public $tipo;
	/**
	 * Quantidade
	 *
	 * @var decimal
	 */
	public $qtde;
	/**
	 * Custo Médio Contábil.
	 *
	 * @var decimal
	 */
	public $cmcUnitario;
	/**
	 * CMC Total
	 *
	 * @var decimal
	 */
	public $cmcTotal;
}

