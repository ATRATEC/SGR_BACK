<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 02 Jan 2018 19:26:30 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ClienteDocumento
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_documento
 * 
 * @property \App\Cliente $cliente
 * @property \App\Documento $documento
 *
 * @package App
 */
class ClienteDocumento extends Eloquent
{
	protected $table = 'cliente_documento';
	public $timestamps = false;

	protected $casts = [
		'id_cliente' => 'int',
		'id_documento' => 'int'
	];

	protected $fillable = [
		'id_cliente',
		'id_documento'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function documento()
	{
		return $this->belongsTo(\App\Documento::class, 'id_documento');
	}
}
