<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 05 Jan 2018 19:44:05 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Preco
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_residuo
 * @property int $id_fornecedor_transportador
 * @property int $id_fornecedor_receptor
 * @property float $preco_cliente
 * @property float $preco
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \App\Fornecedor $fornecedor
 * @property \App\Residuo $residuo
 *
 * @package App
 */
class Preco extends Eloquent
{
	protected $table = 'preco';

	protected $casts = [
		'id_cliente' => 'int',
		'id_residuo' => 'int',
		'id_fornecedor_transportador' => 'int',
		'id_fornecedor_receptor' => 'int',
		'preco_cliente' => 'float',
		'preco' => 'float'
	];

	protected $fillable = [
		'id_cliente',
		'id_residuo',
		'id_fornecedor_transportador',
		'id_fornecedor_receptor',
		'preco_cliente',
		'preco'
	];

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
}
