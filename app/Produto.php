<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 20 Nov 2017 02:28:49 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Produto
 * 
 * @property int $id
 * @property int $codigo_produto
 * @property string $codigo_produto_integracao
 * @property string $codigo
 * @property string $descricao
 * @property string $ean
 * @property string $ncm
 * @property float $quantidade_estoque
 * @property string $csosn_icms
 * @property string $unidade
 * @property float $valor_unitario
 * @property string $cst_icms
 * @property float $aliquota_icms
 * @property float $red_base_icms
 * @property float $aliquota_ibpt
 * @property string $tipoItem
 * @property string $cst_pis
 * @property float $aliquota_pis
 * @property string $cst_cofins
 * @property float $aliquota_cofins
 * @property string $bloqueado
 * @property string $importado_api
 * @property int $id_familia
 * @property int $codigo_familia
 * @property string $codInt_familia
 * @property string $descricao_familia
 * @property string $inativo
 * @property int $id_dadosIbpt
 * @property string $cest
 * @property string $cfop
 * @property float $peso_liq
 * @property float $peso_bruto
 * @property float $estoque_minimo
 * @property string $descr_detalhada
 * @property string $obs_internas
 * @property \Carbon\Carbon $inclusao
 * @property string $usuario_inclusao
 * @property \Carbon\Carbon $alteracao
 * @property string $usuario_alteracao
 * @property string $sincronizar
 *
 * @package App
 */
class Produto extends Eloquent
{
	protected $table = 'produto';
	public $timestamps = false;

	protected $casts = [
		'codigo_produto' => 'int',
		'quantidade_estoque' => 'float',
		'valor_unitario' => 'float',
		'aliquota_icms' => 'float',
		'red_base_icms' => 'float',
		'aliquota_ibpt' => 'float',
		'aliquota_pis' => 'float',
		'aliquota_cofins' => 'float',
		'id_familia' => 'int',
		'codigo_familia' => 'int',
		'id_dadosIbpt' => 'int',
		'peso_liq' => 'float',
		'peso_bruto' => 'float',
		'estoque_minimo' => 'float'
	];

	protected $dates = [
		'inclusao',
		'alteracao'
	];

	protected $fillable = [
		'codigo_produto',
		'codigo_produto_integracao',
		'codigo',
		'descricao',
		'ean',
		'ncm',
		'quantidade_estoque',
		'csosn_icms',
		'unidade',
		'valor_unitario',
		'cst_icms',
		'aliquota_icms',
		'red_base_icms',
		'aliquota_ibpt',
		'tipoItem',
		'cst_pis',
		'aliquota_pis',
		'cst_cofins',
		'aliquota_cofins',
		'bloqueado',
		'importado_api',
		'id_familia',
		'codigo_familia',
		'codInt_familia',
		'descricao_familia',
		'inativo',
		'id_dadosIbpt',
		'cest',
		'cfop',
		'peso_liq',
		'peso_bruto',
		'estoque_minimo',
		'descr_detalhada',
		'obs_internas',
		'inclusao',
		'usuario_inclusao',
		'alteracao',
		'usuario_alteracao',
		'sincronizar'
	];
}
