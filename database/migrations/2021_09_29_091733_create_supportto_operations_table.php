<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupporttoOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supportto_operations', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('ipcrs');
            $table->string('s_output');
            $table->string('s_success_indicator');
            $table->string('s_actual_accomplishment');
            $table->integer('s_quality')->unsigned();
            $table->integer('s_efficiency')->unsigned();
            $table->integer('s_timeliness')->unsigned();
            $table->integer('s_average')->unsigned();
            $table->string('s_remarks');
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
        Schema::dropIfExists('supportto_operations');
    }
}
