<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Dec 2017 03:06:00 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Residuo
 * 
 * @property int $id
 * @property int $codigo
 * @property string $descricao
 * @property int $id_classe
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\ClasseResiduo $classe_residuo
 *
 * @package App
 */
class Residuo extends Eloquent
{
	protected $table = 'residuo';

	protected $casts = [
		'codigo' => 'int',
		'id_classe' => 'int'
	];

	protected $fillable = [
		'codigo',
		'descricao',
		'id_classe'
	];

	public function classe_residuo()
	{
		return $this->belongsTo(\App\ClasseResiduo::class, 'id_classe');
	}
}
