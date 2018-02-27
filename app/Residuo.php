<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Feb 2018 00:04:06 +0000.
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
 * @property int $id_acondicionamento
 * @property int $id_tratamento
 * @property string $codigo_nbr
 * @property string $codigo_onu
 * @property int $tipo_receita
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Acondicionamento $acondicionamento
 * @property \App\ClasseResiduo $classe_residuo
 * @property \App\TipoResiduo $tipo_residuo
 * @property \App\TipoTratamento $tipo_tratamento
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
		'id_tipo_residuo' => 'int',
		'id_acondicionamento' => 'int',
		'id_tratamento' => 'int',
		'tipo_receita' => 'int'
	];

	protected $fillable = [
		'descricao',
		'id_classe',
		'id_tipo_residuo',
		'id_acondicionamento',
		'id_tratamento',
		'codigo_nbr',
		'codigo_onu',
		'tipo_receita'
	];

	public function acondicionamento()
	{
		return $this->belongsTo(\App\Acondicionamento::class, 'id_acondicionamento');
	}

	public function classe_residuo()
	{
		return $this->belongsTo(\App\ClasseResiduo::class, 'id_classe');
	}

	public function tipo_residuo()
	{
		return $this->belongsTo(\App\TipoResiduo::class, 'id_tipo_residuo');
	}

	public function tipo_tratamento()
	{
		return $this->belongsTo(\App\TipoTratamento::class, 'id_tratamento');
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
