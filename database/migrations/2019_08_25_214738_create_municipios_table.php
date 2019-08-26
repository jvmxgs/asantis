<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMunicipiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('municipios', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->integer('estado_id')->index('estado_id')->comment('Relación: estados -> id');
			$table->string('clave', 3)->comment('CVE_MUN – Clave del municipio');
			$table->string('nombre', 100)->comment('NOM_MUN – Nombre del municipio');
			$table->boolean('activo')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('municipios');
	}

}
