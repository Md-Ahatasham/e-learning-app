<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRounderQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounder_qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rounder_id');
            $table->unsignedBigInteger('educational_qualification_id');           
            $table->timestamps();
            $table->foreign('rounder_id')->references('id')->on('users');
            $table->foreign('educational_qualification_id')->references('id')->on('educational_qualifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rounder_qualifications');
    }
}
