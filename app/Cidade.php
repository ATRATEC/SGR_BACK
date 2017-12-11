<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 10 Dec 2017 02:08:52 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Cidade
 * 
 * @property int $id
 * @property string $cCod
 * @property string $cNome
 * @property string $cUF
 * @property string $nCodIBGE
 * @property string $nCodSIAFI
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class Cidade extends Eloquent
{
	protected $table = 'cidade';

	protected $fillable = [
		'cCod',
		'cNome',
		'cUF',
		'nCodIBGE',
		'nCodSIAFI'
	];
}
