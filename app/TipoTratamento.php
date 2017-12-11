<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Dec 2017 03:06:05 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class TipoTratamento
 * 
 * @property int $id
 * @property int $codigo
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class TipoTratamento extends Eloquent
{
	protected $table = 'tipo_tratamento';

	protected $casts = [
		'codigo' => 'int'
	];

	protected $fillable = [
		'codigo',
		'descricao'
	];
}
