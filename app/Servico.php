<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 07 Jan 2018 13:19:21 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Servico
 * 
 * @property int $id
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class Servico extends Eloquent
{
	protected $table = 'servico';

	protected $fillable = [
		'descricao'
	];
}
