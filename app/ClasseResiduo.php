<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 18 Feb 2018 17:28:32 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ClasseResiduo
 * 
 * @property int $id
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $residuos
 *
 * @package App
 */
class ClasseResiduo extends Eloquent
{
	protected $table = 'classe_residuo';

	protected $fillable = [
		'descricao'
	];

	public function residuos()
	{
		return $this->hasMany(\App\Residuo::class, 'id_classe');
	}
}
