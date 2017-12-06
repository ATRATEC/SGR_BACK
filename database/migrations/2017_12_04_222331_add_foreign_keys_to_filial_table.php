<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFilialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('filial', function(Blueprint $table)
		{
			$table->foreign('id_empresa', 'FK_filial_empresa')->references('id')->on('empresa')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('filial', function(Blueprint $table)
		{
			$table->dropForeign('FK_filial_empresa');
		});
	}

}
