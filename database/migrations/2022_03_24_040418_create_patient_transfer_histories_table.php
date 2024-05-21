<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTransferHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_transfer_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('previous_rounder_id')->comment('from which rounder patient had shifted');
            $table->unsignedInteger('current_rounder_id')->comment('to whom patient will be shifted');
            $table->unsignedBigInteger('patient_id');
            $table->string('old_location')->nullable()->default('n/a');
            $table->string('new_location')->nullable()->default('n/a');
            $table->unsignedTinyInteger('transfer_status')->default(0)->comment(" 0 for waiting for accept or decline and 2 is for decline and 1 is for accept");
            $table->unsignedBigInteger('entry_by');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('entry_by')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('patient_transfer_histories');
    }
}
