<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Dec 2017 02:10:26 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Pai
 * 
 * @property int $id
 * @property string $codigo
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class Pai extends Eloquent
{
	protected $fillable = [
		'codigo',
		'descricao'
	];
}
