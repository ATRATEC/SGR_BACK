<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 04 Feb 2018 01:38:40 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoCliente
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_transportador
 * @property int $id_destinador
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
 * @property \App\Fornecedor $fornecedor
 * @property \Illuminate\Database\Eloquent\Collection $servicos
 * @property \Illuminate\Database\Eloquent\Collection $manifestos
 *
 * @package App
 */
class ContratoCliente extends Eloquent
{
	protected $table = 'contrato_cliente';

	protected $casts = [
		'id_cliente' => 'int',
		'id_transportador' => 'int',
		'id_destinador' => 'int',
		'faturamento_minimo' => 'float'
	];

	protected $dates = [
		'vigencia_inicio',
		'vigencia_final'
	];

	protected $fillable = [
		'id_cliente',
		'id_transportador',
		'id_destinador',
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

	public function fornecedor()
	{
		return $this->belongsTo(\App\Fornecedor::class, 'id_transportador');
	}

	public function servicos()
	{
		return $this->belongsToMany(\App\Servico::class, 'contrato_cliente_servico', 'id_contrato_cliente', 'id_servico')
					->withPivot('id', 'id_contrato_fornecedor', 'id_residuo', 'unidade', 'preco_compra', 'preco_servico')
					->withTimestamps();
	}

	public function manifestos()
	{
		return $this->hasMany(\App\Manifesto::class, 'id_contrato_cliente');
	}
}
