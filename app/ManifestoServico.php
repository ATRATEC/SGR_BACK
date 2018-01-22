<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 21 Jan 2018 01:22:28 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ManifestoServico
 * 
 * @property int $id
 * @property int $id_manifesto
 * @property int $id_servico
 * @property int $id_residuo
 * @property int $id_acondicionamento
 * @property int $id_tratamento
 * @property string $unidade
 * @property float $quantidade
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Acondicionamento $acondicionamento
 * @property \App\Manifesto $manifesto
 * @property \App\Residuo $residuo
 * @property \App\Servico $servico
 * @property \App\TipoTratamento $tipo_tratamento
 *
 * @package App
 */
class ManifestoServico extends Eloquent
{
	protected $table = 'manifesto_servico';

	protected $casts = [
		'id_manifesto' => 'int',
		'id_servico' => 'int',
		'id_residuo' => 'int',
		'id_acondicionamento' => 'int',
		'id_tratamento' => 'int',
		'quantidade' => 'float'
	];

	protected $fillable = [
		'id_manifesto',
		'id_servico',
		'id_residuo',
		'id_acondicionamento',
		'id_tratamento',
		'unidade',
		'quantidade'
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

	public function servico()
	{
		return $this->belongsTo(\App\Servico::class, 'id_servico');
	}

	public function tipo_tratamento()
	{
		return $this->belongsTo(\App\TipoTratamento::class, 'id_tratamento');
	}
}
