<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 19 Jan 2018 04:56:11 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoClienteServico
 * 
 * @property int $id
 * @property int $id_contrato_cliente
 * @property int $id_contrato_fornecedor
 * @property int $id_servico
 * @property int $id_residuo
 * @property string $unidade
 * @property float $preco_compra
 * @property float $preco_servico
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\ContratoCliente $contrato_cliente
 * @property \App\ContratoFornecedor $contrato_fornecedor
 * @property \App\Residuo $residuo
 * @property \App\Servico $servico
 *
 * @package App
 */
class ContratoClienteServico extends Eloquent
{
	protected $table = 'contrato_cliente_servico';

	protected $casts = [
		'id_contrato_cliente' => 'int',
		'id_contrato_fornecedor' => 'int',
		'id_servico' => 'int',
		'id_residuo' => 'int',
		'preco_compra' => 'float',
		'preco_servico' => 'float'
	];

	protected $fillable = [
		'id_contrato_cliente',
		'id_contrato_fornecedor',
		'id_servico',
		'id_residuo',
		'unidade',
		'preco_compra',
		'preco_servico'
	];

	public function contrato_cliente()
	{
		return $this->belongsTo(\App\ContratoCliente::class, 'id_contrato_cliente');
	}

	public function contrato_fornecedor()
	{
		return $this->belongsTo(\App\ContratoFornecedor::class, 'id_contrato_fornecedor');
	}

	public function residuo()
	{
		return $this->belongsTo(\App\Residuo::class, 'id_residuo');
	}

	public function servico()
	{
		return $this->belongsTo(\App\Servico::class, 'id_servico');
	}

	public function unidade()
	{
		return $this->belongsTo(\App\Unidade::class, 'unidade', 'codigo');
	}
}
