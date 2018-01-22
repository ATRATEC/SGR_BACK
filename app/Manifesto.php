<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 21 Jan 2018 22:21:25 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Manifesto
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_contrato_cliente
 * @property \Carbon\Carbon $data
 * @property string $numero
 * @property string $observacao
 * @property string $caminho
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \App\ContratoCliente $contrato_cliente
 * @property \Illuminate\Database\Eloquent\Collection $servicos
 *
 * @package App
 */
class Manifesto extends Eloquent
{
	protected $table = 'manifesto';

	protected $casts = [
		'id_cliente' => 'int',
		'id_contrato_cliente' => 'int'
	];

	protected $dates = [
		'data'
	];

	protected $fillable = [
		'id_cliente',
		'id_contrato_cliente',
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

	public function servicos()
	{
		return $this->belongsToMany(\App\Servico::class, 'manifesto_servico', 'id_manifesto', 'id_servico')
					->withPivot('id', 'id_residuo', 'id_acondicionamento', 'id_tratamento', 'unidade', 'quantidade')
					->withTimestamps();
	}
}
