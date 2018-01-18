<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Jan 2018 19:24:25 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Unidade
 * 
 * @property int $id
 * @property string $codigo
 * @property string $descricao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $contrato_fornecedor_servicos
 *
 * @package App
 */
class Unidade extends Eloquent
{
	protected $table = 'unidade';
	public $timestamps = false;

	protected $fillable = [
		'codigo',
		'descricao'
	];

	public function contrato_fornecedor_servicos()
	{
		return $this->hasMany(\App\ContratoFornecedorServico::class, 'unidade', 'codigo');
	}
}
