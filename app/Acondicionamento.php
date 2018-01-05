<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 26 Dec 2017 16:06:14 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Acondicionamento
 * 
 * @property int $id
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class Acondicionamento extends Eloquent
{
	protected $table = 'acondicionamento';

	protected $fillable = [
		'descricao'
	];
}
