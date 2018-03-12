<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Mar 2018 19:05:21 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Equipamento
 * 
 * @property int $id
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class Equipamento extends Eloquent
{
	protected $table = 'equipamento';

	protected $fillable = [
		'descricao'
	];
}
