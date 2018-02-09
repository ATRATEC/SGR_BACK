<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 03 Feb 2018 21:40:15 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoFornecedorResiduo
 * 
 * @property int $id
 * @property int $id_contrato
 * @property int $id_fornecedor
 * @property int $id_residuo
 * @property string $unidade
 * @property float $preco_venda
 * @property float $preco_servico
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\ContratoFornecedor $contrato_fornecedor
 * @property \App\Fornecedor $fornecedor
 * @property \App\Residuo $residuo
 *
 * @package App
 */
class ContratoFornecedorResiduo extends Eloquent
{
	protected $table = 'contrato_fornecedor_residuo';

	protected $casts = [
		'id_contrato' => 'int',
		'id_fornecedor' => 'int',
		'id_residuo' => 'int',
		'preco_venda' => 'float',
		'preco_servico' => 'float'
	];

	protected $fillable = [
		'id_contrato',
		'id_fornecedor',
		'id_residuo',
		'unidade',
		'preco_venda',
		'preco_servico'
	];

	public function contrato_fornecedor()
	{
		return $this->belongsTo(\App\ContratoFornecedor::class, 'id_contrato');
	}

	public function fornecedor()
	{
		return $this->belongsTo(\App\Fornecedor::class, 'id_fornecedor');
	}

	public function residuo()
	{
		return $this->belongsTo(\App\Residuo::class, 'id_residuo');
	}

	public function unidade()
	{
		return $this->belongsTo(\App\Unidade::class, 'unidade', 'codigo');
	}
}
