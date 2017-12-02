<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 20 Nov 2017 02:28:30 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class FamiliaProduto
 * 
 * @property int $Id
 * @property int $codigo
 * @property string $codInt
 * @property string $codFamilia
 * @property string $nomeFamilia
 * @property string $inativo
 * @property string $sincronizar
 *
 * @package App
 */
class FamiliaProduto extends Eloquent
{
	protected $table = 'familia_produto';
	protected $primaryKey = 'Id';
	public $timestamps = false;

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
}
