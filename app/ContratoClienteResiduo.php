<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 14 Feb 2018 01:23:01 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoClienteResiduo
 * 
 * @property int $id
 * @property int $id_contrato_cliente
 * @property int $id_contrato_fornecedor
 * @property int $id_residuo
 * @property int $id_servico
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
class ContratoClienteResiduo extends Eloquent
{
	protected $table = 'contrato_cliente_residuo';

	protected $casts = [
		'id_contrato_cliente' => 'int',
		'id_contrato_fornecedor' => 'int',
		'id_residuo' => 'int',
		'id_servico' => 'int',
		'preco_compra' => 'float',
		'preco_servico' => 'float'
	];

	protected $fillable = [
		'id_contrato_cliente',
		'id_contrato_fornecedor',
		'id_residuo',
		'id_servico',
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
