<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jan 2018 21:40:55 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Servico
 * 
 * @property int $id
 * @property string $descricao
 * @property bool $armazenador
 * @property bool $destinador
 * @property bool $transportador
 * @property bool $outras
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $contrato_clientes
 * @property \Illuminate\Database\Eloquent\Collection $contrato_fornecedors
 * @property \Illuminate\Database\Eloquent\Collection $fornecedors
 * @property \Illuminate\Database\Eloquent\Collection $manifestos
 *
 * @package App
 */
class Servico extends Eloquent
{
	protected $table = 'servico';

	protected $casts = [
		'armazenador' => 'bool',
		'destinador' => 'bool',
		'transportador' => 'bool',
		'outras' => 'bool'
	];

	protected $fillable = [
		'descricao',
		'armazenador',
		'destinador',
		'transportador',
		'outras'
	];

	public function contrato_clientes()
	{
		return $this->belongsToMany(\App\ContratoCliente::class, 'contrato_cliente_servico', 'id_servico', 'id_contrato_cliente')
					->withPivot('id', 'id_contrato_fornecedor', 'id_residuo', 'unidade', 'preco_compra', 'preco_servico')
					->withTimestamps();
	}

	public function contrato_fornecedors()
	{
		return $this->belongsToMany(\App\ContratoFornecedor::class, 'contrato_fornecedor_servico', 'id_servico', 'id_contrato')
					->withPivot('id', 'id_fornecedor', 'unidade', 'preco_compra', 'preco_servico', 'selecionado')
					->withTimestamps();
	}

	public function fornecedors()
	{
		return $this->belongsToMany(\App\Fornecedor::class, 'contrato_fornecedor_servico', 'id_servico', 'id_fornecedor')
					->withPivot('id', 'id_contrato', 'unidade', 'preco_compra', 'preco_servico', 'selecionado')
					->withTimestamps();
	}

	public function manifestos()
	{
		return $this->belongsToMany(\App\Manifesto::class, 'manifesto_servico', 'id_servico', 'id_manifesto')
					->withPivot('id', 'id_residuo', 'id_acondicionamento', 'id_tratamento', 'unidade', 'quantidade')
					->withTimestamps();
	}
}
