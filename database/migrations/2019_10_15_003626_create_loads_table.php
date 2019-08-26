<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loadnumber')->unique();
            $table->string('description');
            $table->unsignedBigInteger('fromestado_id');
            $table->foreign('fromestado_id')->references('id')->on('estados');
            $table->unsignedBigInteger('frommunicipio_id');
            $table->foreign('frommunicipio_id')->references('id')->on('municipios');
            $table->string('fromaddress')->nullable();
            $table->unsignedBigInteger('toestado_id');
            $table->foreign('toestado_id')->references('id')->on('estados');
            $table->unsignedBigInteger('tomunicipio_id');
            $table->foreign('tomunicipio_id')->references('id')->on('municipios');
            $table->string('toaddress');
            $table->string('weight');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loads');
    }
}
