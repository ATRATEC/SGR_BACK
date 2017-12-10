<?php

namespace App\Proxy\MovimentoEstoque;

/**
 * Lista os cadastros de produtos encontrados.
 *
 * @pw_element integer $nCodProd Código do produto.<BR>(Gerado internamente, não é visualizado na tela)
 * @pw_element string $cCodIntProd Código de Integração do produto.<BR>(Utilizado em produtos criados via API, não é visualizado na tela)
 * @pw_element string $cCodigo Código do produto, conforme o fornecedor utiliza.
 * @pw_element string $cDescricao Descrição do produto.
 * @pw_element movimentosArray $movimentos Movimentos de entrada/saída do produto.
 * @pw_complex cadastros
 */
class cadastros{
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
	 * Movimentos de entrada/saída do produto.
	 *
	 * @var movimentosArray
	 */
	public $movimentos;
}
