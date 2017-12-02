<?php

namespace App\Proxy\ConsultaEstoque;

/**
 * Lista a posição do estoque dos produtos encontrados.
 *
 * @pw_element integer $nCodProd Código do Produto.<BR>(Código interno para integração)
 * @pw_element string $cCodigo Código do produto.<BR>(Visualizado na tela).
 * @pw_element string $cDescricao Descrição do produto.
 * @pw_element decimal $nSaldo Saldo do produto.
 * @pw_element decimal $nCMC Custo Médio Contábil.
 * @pw_complex produtos
 */
class produtos{
	/**
	 * Código do Produto.<BR>(Código interno para integração)
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código do produto.<BR>(Visualizado na tela).
	 *
	 * @var string
	 */
	public $cCodigo;
	/**
	 * Descrição do produto.
	 *
	 * @var string
	 */
	public $cDescricao;
	/**
	 * Saldo do produto.
	 *
	 * @var decimal
	 */
	public $nSaldo;
	/**
	 * Custo Médio Contábil.
	 *
	 * @var decimal
	 */
	public $nCMC;
}
