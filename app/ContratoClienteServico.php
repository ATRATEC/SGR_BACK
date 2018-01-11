<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Jan 2018 18:51:51 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoClienteServico
 * 
 * @property int $id
 * @property int $id_contrato_cliente
 * @property int $id_servico
 * @property bool $selecionado
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\ContratoCliente $contrato_cliente
 * @property \App\Servico $servico
 *
 * @package App
 */
class ContratoClienteServico extends Eloquent
{
	protected $table = 'contrato_cliente_servico';

	protected $casts = [
		'id_contrato_cliente' => 'int',
		'id_servico' => 'int',
		'selecionado' => 'bool'
	];

	protected $fillable = [
		'id_contrato_cliente',
		'id_servico',
		'selecionado'
	];

	public function contrato_cliente()
	{
		return $this->belongsTo(\App\ContratoCliente::class, 'id_contrato_cliente');
	}

	public function servico()
	{
		return $this->belongsTo(\App\Servico::class, 'id_servico');
	}
}
