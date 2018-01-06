<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 05 Jan 2018 19:44:22 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Manifesto
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_residuo
 * @property int $id_fornecedor_transportador
 * @property int $id_fornecedor_receptor
 * @property int $id_acondicionamento
 * @property int $id_tratamento
 * @property \Carbon\Carbon $data
 * @property string $numero
 * @property int $quantidade
 * @property string $unidade
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Acondicionamento $acondicionamento
 * @property \App\Cliente $cliente
 * @property \App\Fornecedor $fornecedor
 * @property \App\Residuo $residuo
 * @property \App\TipoTratamento $tipo_tratamento
 *
 * @package App
 */
class Manifesto extends Eloquent
{
	protected $table = 'manifesto';

	protected $casts = [
		'id_cliente' => 'int',
		'id_residuo' => 'int',
		'id_fornecedor_transportador' => 'int',
		'id_fornecedor_receptor' => 'int',
		'id_acondicionamento' => 'int',
		'id_tratamento' => 'int',
		'quantidade' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'id_cliente',
		'id_residuo',
		'id_fornecedor_transportador',
		'id_fornecedor_receptor',
		'id_acondicionamento',
		'id_tratamento',
		'data',
		'numero',
		'quantidade',
		'unidade'
	];

	public function acondicionamento()
	{
		return $this->belongsTo(\App\Acondicionamento::class, 'id_acondicionamento');
	}

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function fornecedor()
	{
		return $this->belongsTo(\App\Fornecedor::class, 'id_fornecedor_transportador');
	}

	public function residuo()
	{
		return $this->belongsTo(\App\Residuo::class, 'id_residuo');
	}

	public function tipo_tratamento()
	{
		return $this->belongsTo(\App\TipoTratamento::class, 'id_tratamento');
	}
}
