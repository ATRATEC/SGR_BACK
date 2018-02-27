<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 21 Feb 2018 02:51:12 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ClienteDocumento
 * 
 * @property int $id
 * @property int $id_tipo_documento
 * @property int $id_cliente
 * @property string $numero
 * @property \Carbon\Carbon $emissao
 * @property \Carbon\Carbon $vencimento
 * @property string $caminho
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \App\TipoDocumento $tipo_documento
 *
 * @package App
 */
class ClienteDocumento extends Eloquent
{
	protected $table = 'cliente_documento';

	protected $casts = [
		'id_tipo_documento' => 'int',
		'id_cliente' => 'int'
	];

	protected $dates = [
		'emissao',
		'vencimento'
	];

	protected $fillable = [
		'id_tipo_documento',
		'id_cliente',
		'numero',
		'emissao',
		'vencimento',
		'caminho'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function tipo_documento()
	{
		return $this->belongsTo(\App\TipoDocumento::class, 'id_tipo_documento');
	}
}
