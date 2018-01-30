<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 30 Jan 2018 16:22:22 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Servico
 * 
 * @property int $id
 * @property string $descricao
 * @property int $id_tipo_atividade
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\TipoAtividade $tipo_atividade
 * @property \Illuminate\Database\Eloquent\Collection $contrato_clientes
 * @property \Illuminate\Database\Eloquent\Collection $contrato_fornecedors
 * @property \Illuminate\Database\Eloquent\Collection $fornecedors
 *
 * @package App
 */
class Servico extends Eloquent
{
	protected $table = 'servico';

	protected $casts = [
		'id_tipo_atividade' => 'int'
	];

	protected $fillable = [
		'descricao',
		'id_tipo_atividade'
	];

	public function tipo_atividade()
	{
		return $this->belongsTo(\App\TipoAtividade::class, 'id_tipo_atividade');
	}

	public function contrato_clientes()
	{
		return $this->belongsToMany(\App\ContratoCliente::class, 'contrato_cliente_servico', 'id_servico', 'id_contrato_cliente')
					->withPivot('id', 'id_contrato_fornecedor', 'id_residuo', 'unidade', 'preco_compra', 'preco_servico')
					->withTimestamps();
	}

	public function contrato_fornecedores()
	{
		return $this->belongsToMany(\App\ContratoFornecedor::class, 'contrato_fornecedor_servico', 'id_servico', 'id_contrato')
					->withPivot('id', 'id_fornecedor', 'unidade', 'preco_compra', 'preco_servico', 'selecionado')
					->withTimestamps();
	}

	public function fornecedores()
	{
		return $this->belongsToMany(\App\Fornecedor::class, 'contrato_fornecedor_servico', 'id_servico', 'id_fornecedor')
					->withPivot('id', 'id_contrato', 'unidade', 'preco_compra', 'preco_servico', 'selecionado')
					->withTimestamps();
	}
}
