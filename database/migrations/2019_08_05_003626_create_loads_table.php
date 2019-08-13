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
            $table->string('pickupfrom')->nullable();
            $table->double('pickupfrom_latitude')->nullable();
            $table->double('pickupfrom_longitude')->nullable();
            $table->string('deliverto');
            $table->double('deliverto_latitude')->nullable();
            $table->double('deliverto_longitude')->nullable();
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
