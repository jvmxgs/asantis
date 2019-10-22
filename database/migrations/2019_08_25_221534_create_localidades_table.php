<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('localidades', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->integer('municipio_id')->index('municipio_id')->comment('Relación: municipios -> id');
			$table->string('clave', 4)->comment('CVE_LOC – Clave de la localidad');
			$table->string('nombre', 100)->comment('NOM_LOC – Nombre de la localidad');
			$table->decimal('lat', 10, 7)->comment('Latitud en decimal');
			$table->decimal('lng', 10, 7)->comment('Longitud en decimal');
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
		Schema::drop('localidades');
	}

}
