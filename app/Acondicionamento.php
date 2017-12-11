<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Dec 2017 03:05:43 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Acondicionamento
 * 
 * @property int $id
 * @property int $codigo
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class Acondicionamento extends Eloquent
{
	protected $table = 'acondicionamento';

	protected $casts = [
		'codigo' => 'int'
	];

	protected $fillable = [
		'codigo',
		'descricao'
	];
}
