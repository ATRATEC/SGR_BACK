<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 04 Mar 2018 04:25:54 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Residuo
 * 
 * @property int $id
 * @property string $descricao
 * @property int $id_classe
 * @property int $id_tipo_residuo
 * @property string $codigo_nbr
 * @property string $codigo_onu
 * @property string $codigo_ibama
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\ClasseResiduo $classe_residuo
 * @property \App\TipoResiduo $tipo_residuo
 * @property \Illuminate\Database\Eloquent\Collection $contrato_clientes
 * @property \Illuminate\Database\Eloquent\Collection $contrato_fornecedors
 * @property \Illuminate\Database\Eloquent\Collection $fornecedors
 * @property \Illuminate\Database\Eloquent\Collection $manifesto_servicos
 * @property \Illuminate\Database\Eloquent\Collection $pesagems
 * @property \Illuminate\Database\Eloquent\Collection $precos
 *
 * @package App
 */
class Residuo extends Eloquent
{
	protected $table = 'residuo';

	protected $casts = [
		'id_classe' => 'int',
		'id_tipo_residuo' => 'int'
	];

	protected $fillable = [
		'descricao',
		'id_classe',
		'id_tipo_residuo',
		'codigo_nbr',
		'codigo_onu',
		'codigo_ibama'
	];

	public function classe_residuo()
	{
		return $this->belongsTo(\App\ClasseResiduo::class, 'id_classe');
	}

	public function tipo_residuo()
	{
		return $this->belongsTo(\App\TipoResiduo::class, 'id_tipo_residuo');
	}

	public function contrato_clientes()
	{
		return $this->belongsToMany(\App\ContratoCliente::class, 'contrato_cliente_residuo', 'id_residuo', 'id_contrato_cliente')
					->withPivot('id', 'id_contrato_fornecedor', 'id_servico', 'unidade', 'preco_compra', 'preco_servico')
					->withTimestamps();
	}

	public function contrato_fornecedors()
	{
		return $this->belongsToMany(\App\ContratoFornecedor::class, 'contrato_fornecedor_residuo', 'id_residuo', 'id_contrato')
					->withPivot('id', 'id_fornecedor', 'id_servico', 'unidade', 'preco_venda', 'preco_servico')
					->withTimestamps();
	}

	public function fornecedors()
	{
		return $this->belongsToMany(\App\Fornecedor::class, 'contrato_fornecedor_residuo', 'id_residuo', 'id_fornecedor')
					->withPivot('id', 'id_contrato', 'id_servico', 'unidade', 'preco_venda', 'preco_servico')
					->withTimestamps();
	}

	public function manifesto_servicos()
	{
		return $this->hasMany(\App\ManifestoServico::class, 'id_residuo');
	}

	public function pesagems()
	{
		return $this->hasMany(\App\Pesagem::class, 'id_residuo');
	}

	public function precos()
	{
		return $this->hasMany(\App\Preco::class, 'id_residuo');
	}
}
