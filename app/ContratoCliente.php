<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 19 Jan 2018 04:56:02 +0000.
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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \Illuminate\Database\Eloquent\Collection $servicos
 *
 * @package App
 */
class ContratoCliente extends Eloquent
{
	protected $table = 'contrato_cliente';

	protected $casts = [
		'id_cliente' => 'int'
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
		'caminho'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function servicos()
	{
		return $this->belongsToMany(\App\Servico::class, 'contrato_cliente_servico', 'id_contrato_cliente', 'id_servico')
					->withPivot('id', 'id_contrato_fornecedor', 'id_residuo', 'unidade', 'preco_compra', 'preco_servico')
					->withTimestamps();
	}
}
