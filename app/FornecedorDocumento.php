<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 05 Jan 2018 19:42:47 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class FornecedorDocumento
 * 
 * @property int $id
 * @property int $id_fornecedor
 * @property int $id_documento
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Documento $documento
 * @property \App\Fornecedor $fornecedor
 *
 * @package App
 */
class FornecedorDocumento extends Eloquent
{
	protected $table = 'fornecedor_documento';

	protected $casts = [
		'id_fornecedor' => 'int',
		'id_documento' => 'int'
	];

	protected $fillable = [
		'id_fornecedor',
		'id_documento'
	];

	public function documento()
	{
		return $this->belongsTo(\App\Documento::class, 'id_documento');
	}

	public function fornecedor()
	{
		return $this->belongsTo(\App\Fornecedor::class, 'id_fornecedor');
	}
}
