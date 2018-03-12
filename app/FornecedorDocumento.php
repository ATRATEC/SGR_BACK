<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Mar 2018 05:23:40 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class FornecedorDocumento
 * 
 * @property int $id
 * @property int $id_tipo_documento
 * @property int $id_fornecedor
 * @property string $numero
 * @property \Carbon\Carbon $emissao
 * @property \Carbon\Carbon $vencimento
 * @property string $caminho
 * @property bool $extensao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Fornecedor $fornecedor
 * @property \App\TipoDocumento $tipo_documento
 *
 * @package App
 */
class FornecedorDocumento extends Eloquent
{
	protected $table = 'fornecedor_documento';

	protected $casts = [
		'id_tipo_documento' => 'int',
		'id_fornecedor' => 'int',
		'extensao' => 'bool'
	];

	protected $dates = [
		'emissao',
		'vencimento'
	];

	protected $fillable = [
		'id_tipo_documento',
		'id_fornecedor',
		'numero',
		'emissao',
		'vencimento',
		'caminho',
		'extensao'
	];

	public function fornecedor()
	{
		return $this->belongsTo(\App\Fornecedor::class, 'id_fornecedor');
	}

	public function tipo_documento()
	{
		return $this->belongsTo(\App\TipoDocumento::class, 'id_tipo_documento');
	}
}
