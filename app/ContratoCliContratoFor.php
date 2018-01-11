<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Jan 2018 18:52:37 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoCliContratoFor
 * 
 * @property int $id
 * @property int $id_contrato_cliente
 * @property int $id_contrato_fornecedor
 * @property int $id_servico
 * @property int $id_residuo
 * @property string $unidade
 * @property float $preco
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
class ContratoCliContratoFor extends Eloquent
{
	protected $table = 'contrato_cli_contrato_for';

	protected $casts = [
		'id_contrato_cliente' => 'int',
		'id_contrato_fornecedor' => 'int',
		'id_servico' => 'int',
		'id_residuo' => 'int',
		'preco' => 'float'
	];

	protected $fillable = [
		'id_contrato_cliente',
		'id_contrato_fornecedor',
		'id_servico',
		'id_residuo',
		'unidade',
		'preco'
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
}
