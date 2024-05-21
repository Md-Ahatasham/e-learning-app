<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoundersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('dob');
            $table->string('age',50);
            $table->string('gender',10)->nullable();
            $table->string('preferred_language',20)->nullable();
            $table->longText('address')->nullable();
            $table->string('phone_number',20)->nullable();
            $table->string('emergency_contact',20)->nullable();
            $table->longText('academic_details')->nullable();
            $table->text('specialist')->nullable();
            $table->string('assign_tab')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rounders');
    }
}
