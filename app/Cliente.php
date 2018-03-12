<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 05 Mar 2018 23:51:42 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Cliente
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
 * @property bool $inativo
 * @property \Carbon\Carbon $inclusao
 * @property string $usuario_inclusao
 * @property \Carbon\Carbon $alteracao
 * @property string $usuario_alteracao
 * @property string $sincronizar
 * @property int $id_empresa
 * @property int $id_filial
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $cliente_documentos
 * @property \Illuminate\Database\Eloquent\Collection $contrato_clientes
 * @property \Illuminate\Database\Eloquent\Collection $contrato_fornecedors
 * @property \Illuminate\Database\Eloquent\Collection $manifestos
 * @property \Illuminate\Database\Eloquent\Collection $pesagems
 * @property \Illuminate\Database\Eloquent\Collection $precos
 *
 * @package App
 */
class Cliente extends Eloquent
{
	protected $table = 'cliente';

	protected $casts = [
		'codigo_omie' => 'int',
		'inativo' => 'bool',
		'id_empresa' => 'int',
		'id_filial' => 'int'
	];

	protected $dates = [
		'nascimento',
		'inclusao',
		'alteracao'
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
		'inativo',
		'inclusao',
		'usuario_inclusao',
		'alteracao',
		'usuario_alteracao',
		'sincronizar',
		'id_empresa',
		'id_filial'
	];

	public function cliente_documentos()
	{
		return $this->hasMany(\App\ClienteDocumento::class, 'id_cliente');
	}

	public function contrato_clientes()
	{
		return $this->hasMany(\App\ContratoCliente::class, 'id_cliente');
	}

	public function contrato_fornecedores()
	{
		return $this->hasMany(\App\ContratoFornecedor::class, 'id_cliente');
	}

	public function manifestos()
	{
		return $this->hasMany(\App\Manifesto::class, 'id_cliente');
	}

	public function pesagems()
	{
		return $this->hasMany(\App\Pesagem::class, 'id_cliente');
	}

	public function precos()
	{
		return $this->hasMany(\App\Preco::class, 'id_cliente');
	}
}
