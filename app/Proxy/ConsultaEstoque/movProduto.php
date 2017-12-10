<?php

namespace App\Proxy\ConsultaEstoque;

/**
 * Movimentação do produto
 *
 * @pw_element string $dtMov Data do movimento
 * @pw_element integer $idMov Identificação do Movimento.
 * @pw_element string $codOrigem Código da Origem
 * @pw_element string $desOrigem Descrição da Origem
 * @pw_element string $numDoc Número do Documento (Nota Fiscal)
 * @pw_element movPeriodoArray $movPeriodo Movimentação no período.
 * @pw_complex movProduto
 */
class movProduto{
	/**
	 * Data do movimento
	 *
	 * @var string
	 */
	public $dtMov;
	/**
	 * Identificação do Movimento.
	 *
	 * @var integer
	 */
	public $idMov;
	/**
	 * Código da Origem
	 *
	 * @var string
	 */
	public $codOrigem;
	/**
	 * Descrição da Origem
	 *
	 * @var string
	 */
	public $desOrigem;
	/**
	 * Número do Documento (Nota Fiscal)
	 *
	 * @var string
	 */
	public $numDoc;
	/**
	 * Movimentação no período.
	 *
	 * @var movPeriodoArray
	 */
	public $movPeriodo;
}
