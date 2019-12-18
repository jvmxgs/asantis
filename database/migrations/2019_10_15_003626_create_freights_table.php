<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('freightnumber')->unique();
            $table->string('description')->nullable();

            $table->unsignedBigInteger('fromlocalidad_id');
            $table->foreign('fromlocalidad_id')->references('id')->on('localidades');
            $table->string('fromaddress');
            $table->dateTime('departuretime');

            $table->unsignedBigInteger('tolocalidad_id');
            $table->foreign('tolocalidad_id')->references('id')->on('localidades');
            $table->string('toaddress');
            $table->dateTime('arrivaltime');

            $table->unsignedInteger('weight');
            $table->enum('weightunit', ['kg', 'lb']);
            $table->enum('trucktype', ['panel', 'rabon', 'caja53', 'termorefrigerado']);
            $table->unsignedInteger('amount');
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
        Schema::dropIfExists('freights');
    }
}
