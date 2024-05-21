<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRounderSpecialitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounder_specialities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rounder_id');
            $table->unsignedBigInteger('specialty_id');           
            $table->timestamps();
            $table->foreign('rounder_id')->references('id')->on('users');
            $table->foreign('specialty_id')->references('id')->on('specialties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rounder_specialities');
    }
}
