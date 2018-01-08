<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 07 Jan 2018 19:44:48 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ClienteDocumento
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_documento
 * @property int $id_tipo_documento
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \App\Documento $documento
 * @property \App\TipoDocumento $tipo_documento
 *
 * @package App
 */
class ClienteDocumento extends Eloquent
{
	protected $table = 'cliente_documento';

	protected $casts = [
		'id_cliente' => 'int',
		'id_documento' => 'int',
		'id_tipo_documento' => 'int'
	];

	protected $fillable = [
		'id_cliente',
		'id_documento',
		'id_tipo_documento'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function documento()
	{
		return $this->belongsTo(\App\Documento::class, 'id_documento');
	}

	public function tipo_documento()
	{
		return $this->belongsTo(\App\TipoDocumento::class, 'id_tipo_documento');
	}
}
