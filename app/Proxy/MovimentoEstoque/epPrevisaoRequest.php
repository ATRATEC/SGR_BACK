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
 * @pw_element string $dDtInicial Data inicial da pesquisa.
 * @pw_element string $dDtFinal Data final da pesquisa.
 * @pw_complex epPrevisaoRequest
 */
class epPrevisaoRequest{
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
	 * Data inicial da pesquisa.
	 *
	 * @var string
	 */
	public $dDtInicial;
	/**
	 * Data final da pesquisa.
	 *
	 * @var string
	 */
	public $dDtFinal;
}
