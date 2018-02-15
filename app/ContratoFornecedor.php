<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 14 Feb 2018 17:17:31 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoFornecedor
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_fornecedor
 * @property string $descricao
 * @property \Carbon\Carbon $vigencia_inicio
 * @property \Carbon\Carbon $vigencia_final
 * @property bool $exclusivo
 * @property string $observacao
 * @property string $caminho
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \App\Fornecedor $fornecedor
 * @property \Illuminate\Database\Eloquent\Collection $contrato_cliente_residuos
 * @property \Illuminate\Database\Eloquent\Collection $residuos
 *
 * @package App
 */
class ContratoFornecedor extends Eloquent
{
	protected $table = 'contrato_fornecedor';

	protected $casts = [
		'id_cliente' => 'int',
		'id_fornecedor' => 'int',
		'exclusivo' => 'bool'
	];

	protected $dates = [
		'vigencia_inicio',
		'vigencia_final'
	];

	protected $fillable = [
		'id_cliente',
		'id_fornecedor',
		'descricao',
		'vigencia_inicio',
		'vigencia_final',
		'exclusivo',
		'observacao',
		'caminho'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function fornecedor()
	{
		return $this->belongsTo(\App\Fornecedor::class, 'id_fornecedor');
	}

	public function contrato_cliente_residuos()
	{
		return $this->hasMany(\App\ContratoClienteResiduo::class, 'id_contrato_fornecedor');
	}

	public function residuos()
	{
		return $this->belongsToMany(\App\Residuo::class, 'contrato_fornecedor_residuo', 'id_contrato', 'id_residuo')
					->withPivot('id', 'id_fornecedor', 'id_servico', 'unidade', 'preco_venda', 'preco_servico')
					->withTimestamps();
	}
}
