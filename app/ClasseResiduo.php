<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Dec 2017 03:05:50 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ClasseResiduo
 * 
 * @property int $id
 * @property int $codigo
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tipo_residuos
 *
 * @package App
 */
class ClasseResiduo extends Eloquent
{
	protected $table = 'classe_residuo';

	protected $casts = [
		'codigo' => 'int'
	];

	protected $fillable = [
		'codigo',
		'descricao'
	];

	public function tipo_residuos()
	{
		return $this->hasMany(\App\Residuo::class, 'id_classe');
	}
}
