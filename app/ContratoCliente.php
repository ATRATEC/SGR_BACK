<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 14 Feb 2018 02:07:14 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoCliente
 * 
 * @property int $id
 * @property int $id_cliente
 * @property string $descricao
 * @property \Carbon\Carbon $vigencia_inicio
 * @property \Carbon\Carbon $vigencia_final
 * @property string $observacao
 * @property string $caminho
 * @property float $faturamento_minimo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \Illuminate\Database\Eloquent\Collection $residuos
 * @property \Illuminate\Database\Eloquent\Collection $manifestos
 *
 * @package App
 */
class ContratoCliente extends Eloquent
{
	protected $table = 'contrato_cliente';

	protected $casts = [
		'id_cliente' => 'int',
		'faturamento_minimo' => 'float'
	];

	protected $dates = [
		'vigencia_inicio',
		'vigencia_final'
	];

	protected $fillable = [
		'id_cliente',
		'descricao',
		'vigencia_inicio',
		'vigencia_final',
		'observacao',
		'caminho',
		'faturamento_minimo'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function residuos()
	{
		return $this->belongsToMany(\App\Residuo::class, 'contrato_cliente_residuo', 'id_contrato_cliente', 'id_residuo')
					->withPivot('id', 'id_contrato_fornecedor', 'id_servico', 'unidade', 'preco_compra', 'preco_servico')
					->withTimestamps();
	}

	public function manifestos()
	{
		return $this->hasMany(\App\Manifesto::class, 'id_contrato_cliente');
	}
}
