<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFornecedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fornecedor', function(Blueprint $table)
		{
			$table->bigInteger('Id', true);
			$table->bigInteger('codigo_omie')->index('idx_fornecedor')->comment('Código do fornecedor - gerado pelo Omie.');
			$table->string('codigo_integracao', 20)->nullable()->index('idx2_fornecedor')->comment('Código de Integração com sistemas legados.');
			$table->string('cnpj_cpf', 20)->nullable()->comment('CNPJ / CPF do fornecedor.');
			$table->string('razao_social', 60)->nullable()->comment('Razão Social do fornecedor');
			$table->string('nome_fantasia', 50)->nullable()->comment('Nome Fantasia do fornecedor');
			$table->string('logradouro', 6)->nullable()->comment('Logradouro');
			$table->string('endereco', 60)->nullable()->comment('Endereço');
			$table->string('endereco_numero', 10)->nullable()->comment('Número do Endereço');
			$table->string('complemento', 60)->nullable()->comment('Complemento para o Número do Endereço');
			$table->string('bairro', 30)->nullable()->comment('Bairro');
			$table->string('cidade', 40)->nullable()->comment('Código da Cidade');
			$table->char('estado', 2)->nullable()->comment('Sigla do Estado');
			$table->string('cep', 10)->nullable()->comment('CEP');
			$table->string('codigo_pais', 4)->nullable()->comment('Código do País');
			$table->date('nascimento')->nullable();
			$table->string('contato', 100)->nullable()->comment('Nome para contato');
			$table->string('telefone1_ddd', 5)->nullable()->comment('DDD Telefone');
			$table->string('telefone1_numero', 15)->nullable()->comment('Telefone para Contato');
			$table->string('telefone2_ddd', 5)->nullable()->comment('DDD Telefone 2');
			$table->string('telefone2_numero', 15)->nullable()->comment('Telefone 2');
			$table->string('fax_ddd', 5)->nullable()->comment('DDD Fax');
			$table->string('fax_numero', 15)->nullable()->comment('Fax');
			$table->string('email', 100)->nullable()->comment('E-Mail');
			$table->string('homepage', 100)->nullable()->comment('WebSite');
			$table->string('observacao', 1024)->nullable()->comment('Observação');
			$table->string('inscricao_municipal', 20)->nullable()->comment('Inscrição Municipal');
			$table->string('inscricao_estadual', 20)->nullable()->comment('Inscrição Estadual');
			$table->string('inscricao_suframa', 20)->nullable()->comment('Inscrição Suframa');
			$table->char('pessoa_fisica', 1)->nullable()->comment('Pessoa Física');
			$table->char('optante_simples_nacional', 1)->nullable()->comment('Indica se o Cliente / Fornecedor é Optante do Simples Nacional [S/N]');
			$table->char('bloqueado', 1)->nullable()->comment('Registro Bloqueado pela API');
			$table->char('importado_api', 1)->nullable()->comment('Gerado da API (S/N)');
			$table->string('cnae', 10)->nullable();
			$table->string('obsEndereco', 512)->nullable();
			$table->string('obsTelefonesEmail', 512)->nullable();
			$table->date('inclusao')->nullable();
			$table->string('usuario_inclusao', 40)->nullable();
			$table->date('alteracao')->nullable();
			$table->string('usuario_alteracao', 40)->nullable();
			$table->char('sincronizar', 1)->nullable()->default('N');
			$table->bigInteger('id_empresa')->nullable();
			$table->bigInteger('id_filial')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fornecedor');
	}

}
