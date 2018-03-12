<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 07 Mar 2018 16:40:04 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class LocacaoEquipamento
 * 
 * @property int $id
 * @property int $id_locacao
 * @property int $id_equipamento
 * @property string $unidade
 * @property float $quantidade
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Equipamento $equipamento
 * @property \App\Locacao $locacao
 *
 * @package App
 */
class LocacaoEquipamento extends Eloquent
{
	protected $table = 'locacao_equipamento';

	protected $casts = [
		'id_locacao' => 'int',
		'id_equipamento' => 'int',
		'quantidade' => 'float'
	];

	protected $fillable = [
		'id_locacao',
		'id_equipamento',
		'unidade',
		'quantidade'
	];

	public function equipamento()
	{
		return $this->belongsTo(\App\Equipamento::class, 'id_equipamento');
	}

	public function locacao()
	{
		return $this->belongsTo(\App\Locacao::class, 'id_locacao');
	}
}
