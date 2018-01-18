<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Jan 2018 04:49:56 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Servico
 * 
 * @property int $id
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $contrato_cli_contrato_fors
 * @property \Illuminate\Database\Eloquent\Collection $contrato_clientes
 * @property \Illuminate\Database\Eloquent\Collection $contrato_fornecedores
 * @property \Illuminate\Database\Eloquent\Collection $fornecedores
 *
 * @package App
 */
class Servico extends Eloquent
{
	protected $table = 'servico';

	protected $fillable = [
		'descricao'
	];

	public function contrato_cli_contrato_fors()
	{
		return $this->hasMany(\App\ContratoCliContratoFor::class, 'id_servico');
	}

	public function contrato_clientes()
	{
		return $this->belongsToMany(\App\ContratoCliente::class, 'contrato_cliente_servico', 'id_servico', 'id_contrato_cliente')
					->withPivot('id', 'selecionado')
					->withTimestamps();
	}

	public function contrato_fornecedores()
	{
		return $this->belongsToMany(\App\ContratoFornecedor::class, 'contrato_fornecedor_servico', 'id_servico', 'id_contrato')
					->withPivot('id', 'id_fornecedor', 'preco_compra', 'preco_servico', 'selecionado')
					->withTimestamps();
	}

	public function fornecedores()
	{
		return $this->belongsToMany(\App\Fornecedor::class, 'contrato_fornecedor_servico', 'id_servico', 'id_fornecedor')
					->withPivot('id', 'id_contrato', 'preco_compra', 'preco_servico', 'selecionado')
					->withTimestamps();
	}
}
