<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Dec 2017 18:31:44 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Fornecedor
 * 
 * @property int $id
 * @property int $codigo_omie
 * @property string $codigo_integracao
 * @property string $cnpj_cpf
 * @property string $razao_social
 * @property string $nome_fantasia
 * @property string $logradouro
 * @property string $endereco
 * @property string $endereco_numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 * @property string $codigo_pais
 * @property \Carbon\Carbon $nascimento
 * @property string $contato
 * @property string $telefone1_ddd
 * @property string $telefone1_numero
 * @property string $telefone2_ddd
 * @property string $telefone2_numero
 * @property string $fax_ddd
 * @property string $fax_numero
 * @property string $email
 * @property string $homepage
 * @property string $observacao
 * @property string $inscricao_municipal
 * @property string $inscricao_estadual
 * @property string $inscricao_suframa
 * @property string $pessoa_fisica
 * @property string $optante_simples_nacional
 * @property string $bloqueado
 * @property string $importado_api
 * @property string $cnae
 * @property string $obsEndereco
 * @property string $obsTelefonesEmail
 * @property \Carbon\Carbon $inclusao
 * @property string $usuario_inclusao
 * @property \Carbon\Carbon $alteracao
 * @property string $usuario_alteracao
 * @property string $sincronizar
 * @property int $id_empresa
 * @property int $id_filial
 * @property int $id_tipoatividade
 * @property string $nrlicencatransp
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $dtemissaotransp
 * @property int $nranostransp
 * @property \Carbon\Carbon $dtvalidadetransp
 * @property string $nrlicencarecep
 * @property \Carbon\Carbon $dtemissaorecep
 * @property int $nranosrecep
 * @property \Carbon\Carbon $dtvalidaderecep
 * 
 * @property \App\TipoAtividade $tipo_atividade
 *
 * @package App
 */
class Fornecedor extends Eloquent
{
	protected $table = 'fornecedor';

	protected $casts = [
		'codigo_omie' => 'int',
		'id_empresa' => 'int',
		'id_filial' => 'int',
		'id_tipoatividade' => 'int',
		'nranostransp' => 'int',
		'nranosrecep' => 'int'
	];

	protected $dates = [
		'nascimento',
		'inclusao',
		'alteracao',
		'dtemissaotransp',
		'dtvalidadetransp',
		'dtemissaorecep',
		'dtvalidaderecep'
	];

	protected $fillable = [
		'codigo_omie',
		'codigo_integracao',
		'cnpj_cpf',
		'razao_social',
		'nome_fantasia',
		'logradouro',
		'endereco',
		'endereco_numero',
		'complemento',
		'bairro',
		'cidade',
		'estado',
		'cep',
		'codigo_pais',
		'nascimento',
		'contato',
		'telefone1_ddd',
		'telefone1_numero',
		'telefone2_ddd',
		'telefone2_numero',
		'fax_ddd',
		'fax_numero',
		'email',
		'homepage',
		'observacao',
		'inscricao_municipal',
		'inscricao_estadual',
		'inscricao_suframa',
		'pessoa_fisica',
		'optante_simples_nacional',
		'bloqueado',
		'importado_api',
		'cnae',
		'obsEndereco',
		'obsTelefonesEmail',
		'inclusao',
		'usuario_inclusao',
		'alteracao',
		'usuario_alteracao',
		'sincronizar',
		'id_empresa',
		'id_filial',
		'id_tipoatividade',
		'nrlicencatransp',
		'dtemissaotransp',
		'nranostransp',
		'dtvalidadetransp',
		'nrlicencarecep',
		'dtemissaorecep',
		'nranosrecep',
		'dtvalidaderecep'
	];

	public function tipo_atividade()
	{
		return $this->belongsTo(\App\TipoAtividade::class, 'id_tipoatividade');
	}
}
