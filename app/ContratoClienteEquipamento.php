<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Mar 2018 19:13:15 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoClienteEquipamento
 * 
 * @property int $id
 * @property int $id_contrato_cliente
 * @property int $id_equipamento
 * @property string $unidade
 * @property float $preco
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\ContratoCliente $contrato_cliente
 * @property \App\Equipamento $equipamento
 *
 * @package App
 */
class ContratoClienteEquipamento extends Eloquent
{
	protected $table = 'contrato_cliente_equipamento';

	protected $casts = [
		'id_contrato_cliente' => 'int',
		'id_equipamento' => 'int',
		'preco' => 'float'
	];

	protected $fillable = [
		'id_contrato_cliente',
		'id_equipamento',
		'unidade',
		'preco'
	];

	public function contrato_cliente()
	{
		return $this->belongsTo(\App\ContratoCliente::class, 'id_contrato_cliente');
	}

	public function equipamento()
	{
		return $this->belongsTo(\App\Equipamento::class, 'id_equipamento');
	}

	public function unidade()
	{
		return $this->belongsTo(\App\Unidade::class, 'unidade', 'codigo');
	}
}
