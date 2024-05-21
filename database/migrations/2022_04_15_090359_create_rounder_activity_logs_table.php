<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRounderActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounder_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rounder_id');
            $table->string('tablet_name',100);
            $table->string("event",255);
            $table->unsignedBigInteger("entry_by");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rounder_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rounder_activity_logs');
    }
}
