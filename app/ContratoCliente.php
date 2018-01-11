<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Jan 2018 18:51:40 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoCliente
 * 
 * @property int $id
 * @property int $id_cliente
 * @property string $descricao
 * @property \Carbon\Carbon $vigencia_inicio
 * @property \Carbon\Carbon $vegencia_final
 * @property string $observacao
 * @property string $caminho
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \Illuminate\Database\Eloquent\Collection $contrato_cli_contrato_fors
 * @property \Illuminate\Database\Eloquent\Collection $servicos
 *
 * @package App
 */
class ContratoCliente extends Eloquent
{
	protected $table = 'contrato_cliente';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'id_cliente' => 'int'
	];

	protected $dates = [
		'vigencia_inicio',
		'vegencia_final'
	];

	protected $fillable = [
		'id_cliente',
		'descricao',
		'vigencia_inicio',
		'vegencia_final',
		'observacao',
		'caminho'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function contrato_cli_contrato_fors()
	{
		return $this->hasMany(\App\ContratoCliContratoFor::class, 'id_contrato_cliente');
	}

	public function servicos()
	{
		return $this->belongsToMany(\App\Servico::class, 'contrato_cliente_servico', 'id_contrato_cliente', 'id_servico')
					->withPivot('id', 'selecionado')
					->withTimestamps();
	}
}
