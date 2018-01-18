<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jan 2018 19:23:47 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoFornecedorServico
 * 
 * @property int $id
 * @property int $id_contrato
 * @property int $id_fornecedor
 * @property int $id_servico
 * @property string $unidade
 * @property float $preco_compra
 * @property float $preco_servico
 * @property bool $selecionado
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\ContratoFornecedor $contrato_fornecedor
 * @property \App\Fornecedor $fornecedor
 * @property \App\Servico $servico
 *
 * @package App
 */
class ContratoFornecedorServico extends Eloquent
{
	protected $table = 'contrato_fornecedor_servico';

	protected $casts = [
		'id_contrato' => 'int',
		'id_fornecedor' => 'int',
		'id_servico' => 'int',
		'preco_compra' => 'float',
		'preco_servico' => 'float',
		'selecionado' => 'bool'
	];

	protected $fillable = [
		'id_contrato',
		'id_fornecedor',
		'id_servico',
		'unidade',
		'preco_compra',
		'preco_servico',
		'selecionado'
	];

	public function contrato_fornecedor()
	{
		return $this->belongsTo(\App\ContratoFornecedor::class, 'id_contrato');
	}

	public function fornecedor()
	{
		return $this->belongsTo(\App\Fornecedor::class, 'id_fornecedor');
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
