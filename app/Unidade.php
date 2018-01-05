<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 05 Jan 2018 15:54:01 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Unidade
 * 
 * @property int $id
 * @property string $codigo
 * @property string $descricao
 *
 * @package App
 */
class Unidade extends Eloquent
{
	protected $table = 'unidade';
	public $timestamps = false;

	protected $fillable = [
		'codigo',
		'descricao'
	];
}
