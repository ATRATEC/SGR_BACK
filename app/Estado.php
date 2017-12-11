<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Dec 2017 02:09:22 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Estado
 * 
 * @property int $id
 * @property string $uf
 * @property string $nome
 * @property int $cod_ibge
 *
 * @package App
 */
class Estado extends Eloquent
{
	protected $table = 'estado';
	public $timestamps = false;

	protected $casts = [
		'cod_ibge' => 'int'
	];

	protected $fillable = [
		'uf',
		'nome',
		'cod_ibge'
	];
}
