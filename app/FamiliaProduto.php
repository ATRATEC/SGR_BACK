<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Dec 2017 02:05:58 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class FamiliaProduto
 * 
 * @property int $id
 * @property int $codigo
 * @property string $codInt
 * @property string $codFamilia
 * @property string $nomeFamilia
 * @property string $inativo
 * @property string $sincronizar
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $produtos
 *
 * @package App
 */
class FamiliaProduto extends Eloquent
{
	protected $table = 'familia_produto';

	protected $casts = [
		'codigo' => 'int'
	];

	protected $fillable = [
		'codigo',
		'codInt',
		'codFamilia',
		'nomeFamilia',
		'inativo',
		'sincronizar'
	];

	public function produtos()
	{
		return $this->hasMany(\App\Produto::class, 'id_familia');
	}
}
