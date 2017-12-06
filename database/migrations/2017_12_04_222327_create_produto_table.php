<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produto', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->comment('Identificador interno do produto');
			$table->integer('codigo_produto')->index('idx_produto');
			$table->string('codigo_produto_integracao', 20)->nullable()->comment('codigo de integração de produto entre sistemas');
			$table->string('codigo', 20)->unique('UK_produto')->comment('codigo de visualização do usuario');
			$table->string('descricao', 100)->comment('descricao do produto');
			$table->string('ean', 14)->nullable()->comment('GTIN (Global Trade Item Number)');
			$table->string('ncm', 20)->comment('Código da Nomenclatura Comum do Mercosul');
			$table->decimal('quantidade_estoque', 10, 0)->nullable()->comment('Quantidade em Estoque');
			$table->string('csosn_icms', 3)->nullable()->comment('Código da Situação Tributária para Simples Nacional');
			$table->string('unidade', 6)->comment('Código da Unidade');
			$table->decimal('valor_unitario', 10)->nullable()->comment('Valor unitário de Venda');
			$table->string('cst_icms', 2)->nullable()->comment('CST do ICMS');
			$table->decimal('aliquota_icms', 10)->nullable()->comment('Alíquota de ICMS ');
			$table->decimal('red_base_icms', 10)->nullable()->comment('Percentual de redução de base do ICMS');
			$table->decimal('aliquota_ibpt', 10)->nullable()->comment('Mantido apenas para compatibilidade - Sempre retorna ZERO.');
			$table->string('tipoItem', 2)->nullable()->comment('Código do Tipo do Item para o SPED');
			$table->string('cst_pis', 2)->nullable()->comment('Código da Situação Tributária do PIS');
			$table->decimal('aliquota_pis', 10, 0)->nullable()->comment('Alíquota de PIS');
			$table->string('cst_cofins', 2)->nullable()->comment('Código da Situação Tributária do Cofins');
			$table->decimal('aliquota_cofins', 10)->nullable()->comment('Alíquota de COFINS ');
			$table->char('bloqueado', 1)->nullable()->comment('Cadastro Bloqueado pela API');
			$table->char('importado_api', 1)->nullable()->comment('Gerado pela API');
			$table->bigInteger('id_familia')->nullable()->index('fk_produto_familia');
			$table->integer('codigo_familia')->nullable()->comment('Código da Familia');
			$table->string('codInt_familia', 20)->nullable()->comment('Código de Integração da Familia');
			$table->string('descricao_familia', 50)->nullable()->comment('Descrição da Familia ');
			$table->char('inativo', 1)->nullable()->comment('Indica se o cadstro de produto está inativo [S/N]');
			$table->integer('id_dadosIbpt')->nullable()->comment('Dados do IBPT');
			$table->string('cest', 9)->nullable()->comment('Código do CEST.');
			$table->string('cfop', 10)->nullable()->comment('CFOP do Produto.');
			$table->decimal('peso_liq', 10)->nullable()->comment('Peso Líquido (Kg)');
			$table->decimal('peso_bruto', 10)->nullable()->comment('Peso Bruto (Kg)');
			$table->decimal('estoque_minimo', 10, 0)->nullable()->comment('Quantidade do Estoque Mínimo');
			$table->string('descr_detalhada', 1024)->nullable()->comment('Descrição Detalhada para o Produto');
			$table->string('obs_internas', 1024)->nullable()->comment('Observações Internas');
			$table->date('inclusao')->nullable();
			$table->string('usuario_inclusao', 40)->nullable();
			$table->date('alteracao')->nullable();
			$table->string('usuario_alteracao', 40)->nullable();
			$table->char('sincronizar', 1)->nullable()->default('N');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produto');
	}

}
