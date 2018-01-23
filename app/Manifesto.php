<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 23 Jan 2018 00:15:12 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Manifesto
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_contrato_cliente
 * @property int $id_transportador
 * @property int $id_destinador
 * @property \Carbon\Carbon $data
 * @property string $numero
 * @property string $observacao
 * @property string $caminho
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \App\ContratoCliente $contrato_cliente
 * @property \App\Fornecedor $fornecedor
 * @property \Illuminate\Database\Eloquent\Collection $servicos
 *
 * @package App
 */
class Manifesto extends Eloquent
{
	protected $table = 'manifesto';

	protected $casts = [
		'id_cliente' => 'int',
		'id_contrato_cliente' => 'int',
		'id_transportador' => 'int',
		'id_destinador' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'id_cliente',
		'id_contrato_cliente',
		'id_transportador',
		'id_destinador',
		'data',
		'numero',
		'observacao',
		'caminho'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function contrato_cliente()
	{
		return $this->belongsTo(\App\ContratoCliente::class, 'id_contrato_cliente');
	}

	public function fornecedor()
	{
		return $this->belongsTo(\App\Fornecedor::class, 'id_transportador');
	}

	public function servicos()
	{
		return $this->belongsToMany(\App\Servico::class, 'manifesto_servico', 'id_manifesto', 'id_servico')
					->withPivot('id', 'id_residuo', 'id_acondicionamento', 'id_tratamento', 'unidade', 'quantidade')
					->withTimestamps();
	}
}
