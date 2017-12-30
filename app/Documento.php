<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 26 Dec 2017 16:13:04 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Documento
 * 
 * @property int $id
 * @property int $id_tipo_documento
 * @property string $numero
 * @property \Carbon\Carbon $emissao
 * @property \Carbon\Carbon $vencimento
 * @property string $caminho
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\TipoDocumento $tipo_documento
 * @property \Illuminate\Database\Eloquent\Collection $clientes
 * @property \Illuminate\Database\Eloquent\Collection $fornecedors
 *
 * @package App
 */
class Documento extends Eloquent
{
	protected $table = 'documento';

	protected $casts = [
		'id_tipo_documento' => 'int'
	];

	protected $dates = [
		'emissao',
		'vencimento'
	];

	protected $fillable = [
		'id_tipo_documento',
		'numero',
		'emissao',
		'vencimento',
		'caminho'
	];

	public function tipo_documento()
	{
		return $this->belongsTo(\App\TipoDocumento::class, 'id_tipo_documento');
	}

	public function clientes()
	{
		return $this->belongsToMany(\App\Cliente::class, 'cliente_documento', 'id_documento', 'id_cliente')
					->withPivot('id');
	}

	public function fornecedores()
	{
		return $this->belongsToMany(\App\Fornecedor::class, 'fornecedor_documento', 'id_documento', 'id_fornecedor')
					->withPivot('id');
	}
}
