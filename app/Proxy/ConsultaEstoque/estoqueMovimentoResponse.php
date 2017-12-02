<?php

namespace App\Proxy\ConsultaEstoque;

/**
 * Resposta do consulta de movimentação do Estoque
 *
 * @pw_element integer $id_prod Código do Produto
 * @pw_element string $cod_int Código de Integração do Produto
 * @pw_element string $descricao Descrição do produto.
 * @pw_element movProdutoArray $movProduto Movimentação do produto
 * @pw_complex estoqueMovimentoResponse
 */
class estoqueMovimentoResponse{
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
	 * Descrição do produto.
	 *
	 * @var string
	 */
	public $descricao;
	/**
	 * Movimentação do produto
	 *
	 * @var movProdutoArray
	 */
	public $movProduto;
}
