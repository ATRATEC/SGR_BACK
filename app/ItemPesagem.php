<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 10 Mar 2018 23:04:48 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ItemPesagem
 * 
 * @property int $id
 * @property int $id_pesagem
 * @property int $id_residuo
 * @property string $unidade
 * @property float $peso
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Pesagem $pesagem
 * @property \App\Residuo $residuo
 *
 * @package App
 */
class ItemPesagem extends Eloquent
{
	protected $table = 'item_pesagem';

	protected $casts = [
		'id_pesagem' => 'int',
		'id_residuo' => 'int',
		'peso' => 'float'
	];

	protected $fillable = [
		'id_pesagem',
		'id_residuo',
		'unidade',
		'peso'
	];

	public function pesagem()
	{
		return $this->belongsTo(\App\Pesagem::class, 'id_pesagem');
	}

	public function residuo()
	{
		return $this->belongsTo(\App\Residuo::class, 'id_residuo');
	}
}
