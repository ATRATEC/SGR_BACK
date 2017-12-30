<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Dec 2017 03:05:54 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class TipoAtividade
 * 
 * @property int $id
 * @property int $codigo
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class TipoAtividade extends Eloquent
{
	protected $table = 'tipo_atividade';
	
	protected $fillable = [
		'descricao'
	];
}
