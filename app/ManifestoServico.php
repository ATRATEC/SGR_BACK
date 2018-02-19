<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 19 Feb 2018 19:31:10 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ManifestoServico
 * 
 * @property int $id
 * @property int $id_manifesto
 * @property int $id_residuo
 * @property int $id_tipo_residuo
 * @property int $id_acondicionamento
 * @property int $id_tratamento
 * @property string $unidade
 * @property float $quantidade
 * @property float $quantidade_final
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Acondicionamento $acondicionamento
 * @property \App\Manifesto $manifesto
 * @property \App\Residuo $residuo
 * @property \App\TipoResiduo $tipo_residuo
 * @property \App\TipoTratamento $tipo_tratamento
 *
 * @package App
 */
class ManifestoServico extends Eloquent
{
	protected $table = 'manifesto_servico';

	protected $casts = [
		'id_manifesto' => 'int',
		'id_residuo' => 'int',
		'id_tipo_residuo' => 'int',
		'id_acondicionamento' => 'int',
		'id_tratamento' => 'int',
		'quantidade' => 'float',
		'quantidade_final' => 'float'
	];

	protected $fillable = [
		'id_manifesto',
		'id_residuo',
		'id_tipo_residuo',
		'id_acondicionamento',
		'id_tratamento',
		'unidade',
		'quantidade',
		'quantidade_final'
	];

	public function acondicionamento()
	{
		return $this->belongsTo(\App\Acondicionamento::class, 'id_acondicionamento');
	}

	public function manifesto()
	{
		return $this->belongsTo(\App\Manifesto::class, 'id_manifesto');
	}

	public function residuo()
	{
		return $this->belongsTo(\App\Residuo::class, 'id_residuo');
	}

	public function tipo_residuo()
	{
		return $this->belongsTo(\App\TipoResiduo::class, 'id_tipo_residuo');
	}

	public function tipo_tratamento()
	{
		return $this->belongsTo(\App\TipoTratamento::class, 'id_tratamento');
	}
}
