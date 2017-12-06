<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filial', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('id_empresa')->index('FK_filial_empresa');
			$table->bigInteger('codigo_filial')->nullable();
			$table->string('codigo_filial_integracao', 20)->nullable();
			$table->string('cnpj', 20);
			$table->string('razao_social', 60);
			$table->string('nome_fantasia', 50);
			$table->string('logradouro', 6)->nullable();
			$table->string('endereco', 60)->nullable();
			$table->string('endereco_numero', 10)->nullable();
			$table->string('complemento', 60)->nullable();
			$table->string('bairro', 30)->nullable();
			$table->string('cidade', 40)->nullable();
			$table->char('estado', 2)->nullable();
			$table->string('cep', 10)->nullable();
			$table->string('codigo_pais', 4)->nullable();
			$table->date('data_adesao_sn')->nullable();
			$table->string('telefone1_ddd', 5)->nullable();
			$table->string('telefone1_numero', 15)->nullable();
			$table->string('telefone2_ddd', 5)->nullable();
			$table->string('telefone2_numero', 15)->nullable();
			$table->string('fax_ddd', 5)->nullable();
			$table->string('fax_numero', 15)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('website', 100)->nullable();
			$table->string('cnae', 10)->nullable();
			$table->string('cnae_municipal', 10)->nullable();
			$table->string('inscricao_estadual', 20)->nullable();
			$table->string('inscricao_municipal', 20)->nullable();
			$table->string('inscricao_suframa', 20)->nullable();
			$table->boolean('regime_tributario')->nullable();
			$table->char('inativa', 1)->nullable();
			$table->char('gera_nfse', 1)->nullable();
			$table->char('optante_simples_nacional', 1)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('filial');
	}

}
