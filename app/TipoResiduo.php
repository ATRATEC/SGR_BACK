<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jan 2018 14:58:18 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class TipoResiduo
 * 
 * @property int $id
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class TipoResiduo extends Eloquent
{
	protected $table = 'tipo_residuo';

	protected $fillable = [
		'descricao'
	];
}
