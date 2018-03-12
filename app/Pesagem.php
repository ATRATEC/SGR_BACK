<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 12 Mar 2018 03:02:16 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Pesagem
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
 * @property \Illuminate\Database\Eloquent\Collection $item_pesagems
 *
 * @package App
 */
class Pesagem extends Eloquent
{
	protected $table = 'pesagem';

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

	public function item_pesagems()
	{
		return $this->hasMany(\App\ItemPesagem::class, 'id_pesagem');
	}
}
