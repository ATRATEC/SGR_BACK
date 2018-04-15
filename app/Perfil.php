<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Apr 2018 00:17:03 +0000.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Perfil
 * 
 * @property int $id
 * @property string $descricao
 * @property string $cadastros
 * @property string $cadastros_servico
 * @property string $cadastros_cliente
 * @property string $cadastros_contrato_cliente
 * @property string $cadastros_contrato_fornecedor
 * @property string $cadastros_documento_cliente
 * @property string $cadastros_documento_fornecedor
 * @property string $cadastros_fornecedor
 * @property string $cadastros_residuo_acondicionamento
 * @property string $cadastros_residuo_classe_residuo
 * @property string $cadastros_residuo_residuos
 * @property string $cadastros_residuo_tipo_tratamento
 * @property string $cadastros_residuo_tipo_residuo
 * @property string $cadastros_residuo_unidade
 * @property string $cadastros_equipamento
 * @property string $processos
 * @property string $processos_manifesto
 * @property string $processos_monitor_documento
 * @property string $processos_apuracao_locacao
 * @property string $processos_pesagem
 * @property string $relatorios
 * @property string $relatorios_gerencia_cliente
 * @property string $relatorios_gerencia_ambiente_verde
 * @property string $relatorios_controle_pesagem
 * @property string $relatorios_mapa_residuos
 * @property string $relatorios_controle_pagamento
 * @property string $relatorios_consolidado_periodo
 * @property string $relatorios_protocolo_entrega
 * @property string $aclcontrol_adicionar_usuario
 * @property string $aclcontrol_redefinir_senha
 * 
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App
 */
class Perfil extends Eloquent
{
	protected $table = 'perfil';
	public $timestamps = false;

	protected $fillable = [
		'descricao',
		'cadastros',
		'cadastros_servico',
		'cadastros_cliente',
		'cadastros_contrato_cliente',
		'cadastros_contrato_fornecedor',
		'cadastros_documento_cliente',
		'cadastros_documento_fornecedor',
		'cadastros_fornecedor',
		'cadastros_residuo_acondicionamento',
		'cadastros_residuo_classe_residuo',
		'cadastros_residuo_residuos',
		'cadastros_residuo_tipo_tratamento',
		'cadastros_residuo_tipo_residuo',
		'cadastros_residuo_unidade',
		'cadastros_equipamento',
		'processos',
		'processos_manifesto',
		'processos_monitor_documento',
		'processos_apuracao_locacao',
		'processos_pesagem',
		'relatorios',
		'relatorios_gerencia_cliente',
		'relatorios_gerencia_ambiente_verde',
		'relatorios_controle_pesagem',
		'relatorios_mapa_residuos',
		'relatorios_controle_pagamento',
		'relatorios_consolidado_periodo',
		'relatorios_protocolo_entrega',
		'aclcontrol_adicionar_usuario',
		'aclcontrol_redefinir_senha'
	];

	public function users()
	{
		return $this->hasMany(\App\User::class, 'id_perfil');
	}
}
