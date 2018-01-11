<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 10 Jan 2018 13:35:43 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ContratoFornecedor
 * 
 * @property int $id
 * @property int $id_cliente
 * @property int $id_fornecedor
 * @property string $descricao
 * @property \Carbon\Carbon $vigencia_inicio
 * @property \Carbon\Carbon $vigencia_final
 * @property bool $exclusivo
 * @property string $observacao
 * @property string $caminho
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Cliente $cliente
 * @property \App\Fornecedor $fornecedor
 * @property \Illuminate\Database\Eloquent\Collection $contrato_cli_contrato_fors
 * @property \Illuminate\Database\Eloquent\Collection $servicos
 *
 * @package App
 */
class ContratoFornecedor extends Eloquent
{
	protected $table = 'contrato_fornecedor';

	protected $casts = [
		'id_cliente' => 'int',
		'id_fornecedor' => 'int',
		'exclusivo' => 'bool'
	];

	protected $dates = [
		'vigencia_inicio',
		'vigencia_final'
	];

	protected $fillable = [
		'id_cliente',
		'id_fornecedor',
		'descricao',
		'vigencia_inicio',
		'vigencia_final',
		'exclusivo',
		'observacao',
		'caminho'
	];

	public function cliente()
	{
		return $this->belongsTo(\App\Cliente::class, 'id_cliente');
	}

	public function fornecedor()
	{
		return $this->belongsTo(\App\Fornecedor::class, 'id_fornecedor');
	}

	public function contrato_cli_contrato_fors()
	{
		return $this->hasMany(\App\ContratoCliContratoFor::class, 'id_contrato_fornecedor');
	}

//	public function servicos()
//	{
//		return $this->belongsToMany(\App\Servico::class, 'contrato_fornecedor_servico', 'id_contrato', 'id_servico')
//					->withPivot('id', 'id_fornecedor', 'preco', 'selecionado')
//					->withTimestamps();
//	}
        
        public function servicos()
	{
		return $this->belongsToMany(\App\Servico::class, 'contrato_fornecedor_servico', 'id_contrato', 'id_servico')
					->withPivot('id', 'id_fornecedor', 'preco', 'selecionado')
					->withTimestamps();
	}
}
