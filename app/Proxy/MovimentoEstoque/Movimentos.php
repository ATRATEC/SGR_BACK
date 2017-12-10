<?php

namespace App\Proxy\MovimentoEstoque;

/**
 * Movimentos de entrada/saída do produto.
 *
 * @pw_element string $dDataMovimento Data do movimento.
 * @pw_element decimal $nQtdeEntradas Quantidade total de entradas para o dia.
 * @pw_element decimal $nQtdeSaidas Quantidade total de saídas para o dia.
 * @pw_complex movimentos
 */
class movimentos{
	/**
	 * Data do movimento.
	 *
	 * @var string
	 */
	public $dDataMovimento;
	/**
	 * Quantidade total de entradas para o dia.
	 *
	 * @var decimal
	 */
	public $nQtdeEntradas;
	/**
	 * Quantidade total de saídas para o dia.
	 *
	 * @var decimal
	 */
	public $nQtdeSaidas;
}
