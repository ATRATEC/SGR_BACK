<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 07 Mar 2018 16:39:43 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Locacao
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_contrato_cliente
 * @property \Carbon\Carbon $data
 * @property string $observacao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \App\ContratoCliente $contrato_cliente
 * @property \Illuminate\Database\Eloquent\Collection $equipamentos
 *
 * @package App
 */
class Locacao extends Eloquent
{
	protected $table = 'locacao';

	protected $casts = [
		'id_cliente' => 'int',
		'id_contrato_cliente' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'id_cliente',
		'id_contrato_cliente',
		'data',
		'observacao'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function contrato_cliente()
	{
		return $this->belongsTo(\App\ContratoCliente::class, 'id_contrato_cliente');
	}

	public function equipamentos()
	{
		return $this->belongsToMany(\App\Equipamento::class, 'locacao_equipamento', 'id_locacao', 'id_equipamento')
					->withPivot('id', 'unidade', 'quantidade')
					->withTimestamps();
	}
}
