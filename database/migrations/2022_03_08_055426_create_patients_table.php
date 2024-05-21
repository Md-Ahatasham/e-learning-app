<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('preferred_name',100);
            $table->date('dob',100);
            $table->string('age',10);
            $table->string('gender',10);
            $table->string('preferred_language',20);
            $table->text('address');
            $table->string('phone_number',20);
            $table->string('emergency_contact',20);
            $table->unsignedInteger('unit');
            $table->unsignedInteger('room');
            $table->unsignedInteger('bed');
            $table->unsignedInteger('interval');
            $table->unsignedBigInteger('assigned_rounder_id')->nullable();
            $table->text('admission_notes')->nullable();
            $table->string('patient_picture')->nullable();
            $table->date('admission_date');
            $table->unsignedTinyInteger('status')->default(1)->comment("0 is discharged and 1 is active 5 is queued 2 is waiting for transfer");
            $table->unsignedBigInteger('entry_by');           
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('entry_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
