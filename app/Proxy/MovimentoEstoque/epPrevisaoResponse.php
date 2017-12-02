<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Proxy\MovimentoEstoque;

/**
 * Previsão de estoque do produto.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Gerado internamente, não é visualizado na tela)
 * @pw_element string $cCodIntProd Código de Integração do produto.<BR>(Utilizado em produtos criados via API, não é visualizado na tela)
 * @pw_element string $cCodigo Código do produto, conforme o fornecedor utiliza.
 * @pw_element string $cDescricao Descrição do produto.
 * @pw_element decimal $nQtdePrevista Quantidade prevista de estoque.
 * @pw_complex epPrevisaoResponse
 */
class epPrevisaoResponse{
	/**
	 * Código do produto.<BR>(Gerado internamente, não é visualizado na tela)
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código de Integração do produto.<BR>(Utilizado em produtos criados via API, não é visualizado na tela)
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código do produto, conforme o fornecedor utiliza.
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
	 * Quantidade prevista de estoque.
	 *
	 * @var decimal
	 */
	public $nQtdePrevista;
}

