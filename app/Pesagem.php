<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 05 Jan 2018 19:44:14 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Pesagem
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_residuo
 * @property \Carbon\Carbon $data
 * @property int $quantidade
 * @property float $peso
 * @property string $unidade
 * @property float $peso_total
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \App\Residuo $residuo
 *
 * @package App
 */
class Pesagem extends Eloquent
{
	protected $table = 'pesagem';

	protected $casts = [
		'id_cliente' => 'int',
		'id_residuo' => 'int',
		'quantidade' => 'int',
		'peso' => 'float',
		'peso_total' => 'float'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'id_cliente',
		'id_residuo',
		'data',
		'quantidade',
		'peso',
		'unidade',
		'peso_total'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function residuo()
	{
		return $this->belongsTo(\App\Residuo::class, 'id_residuo');
	}
}
