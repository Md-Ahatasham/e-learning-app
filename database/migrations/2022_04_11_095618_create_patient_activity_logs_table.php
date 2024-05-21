<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->dateTime('date');
            $table->string('event',255);
            $table->unsignedBigInteger('entry_by');
            $table->timestamps();
            $table->softDeletes();           
            $table->foreign('patient_id')->references('id')->on('patients');
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
        Schema::dropIfExists('patient_activity_logs');
    }
}
