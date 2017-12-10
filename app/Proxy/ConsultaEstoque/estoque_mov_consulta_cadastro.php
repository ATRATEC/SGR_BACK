<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Proxy\ConsultaEstoque;

/**
 * Registro de Consulta de Estoque
 *
 * @pw_element integer $id_prod ID do Produto
 * @pw_element string $cod_int Código de Integração do Produto
 * @pw_element string $data Data da Consulta de Estoque
 * @pw_complex estoque_mov_consulta_cadastro
 */
class estoque_mov_consulta_cadastro{
	/**
	 * ID do Produto
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
	 * Data da Consulta de Estoque
	 *
	 * @var string
	 */
	public $data;
}
