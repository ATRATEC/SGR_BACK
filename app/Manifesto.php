<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 23 Mar 2018 03:56:10 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Manifesto
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_contrato_cliente
 * @property int $id_transportador
 * @property int $id_destinador
 * @property \Carbon\Carbon $data
 * @property string $numero
 * @property string $observacao
 * @property string $caminho
 * @property string $pago
 * @property \Carbon\Carbon $previsao_pagamento
 * @property \Carbon\Carbon $data_pagamento
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \App\ContratoCliente $contrato_cliente
 * @property \App\Fornecedor $fornecedor
 * @property \Illuminate\Database\Eloquent\Collection $manifesto_servicos
 *
 * @package App
 */
class Manifesto extends Eloquent
{
	protected $table = 'manifesto';

	protected $casts = [
		'id_cliente' => 'int',
		'id_contrato_cliente' => 'int',
		'id_transportador' => 'int',
		'id_destinador' => 'int'
	];

	protected $dates = [
		'data',
		'previsao_pagamento',
		'data_pagamento'
	];

	protected $fillable = [
		'id_cliente',
		'id_contrato_cliente',
		'id_transportador',
		'id_destinador',
		'data',
		'numero',
		'observacao',
		'caminho',
		'pago',
		'previsao_pagamento',
		'data_pagamento'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function contrato_cliente()
	{
		return $this->belongsTo(\App\ContratoCliente::class, 'id_contrato_cliente');
	}

	public function fornecedor()
	{
		return $this->belongsTo(\App\Fornecedor::class, 'id_transportador');
	}

	public function manifesto_servicos()
	{
		return $this->hasMany(\App\ManifestoServico::class, 'id_manifesto');
	}
}
