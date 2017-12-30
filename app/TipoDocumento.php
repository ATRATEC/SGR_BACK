<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 26 Dec 2017 16:12:55 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class TipoDocumento
 * 
 * @property int $id
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $documentos
 *
 * @package App
 */
class TipoDocumento extends Eloquent
{
	protected $table = 'tipo_documento';

	protected $fillable = [
		'descricao'
	];

	public function documentos()
	{
		return $this->hasMany(\App\Documento::class, 'id_tipo_documento');
	}
}
