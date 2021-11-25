<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('ipcrs');
            $table->string('o_type');
            $table->string('o_output');
            $table->string('o_success_indicator');
            $table->string('o_actual_accomplishment');
            $table->integer('o_quality')->unsigned();
            $table->integer('o_efficiency')->unsigned();
            $table->integer('o_timeliness')->unsigned();
            $table->integer('o_average')->unsigned();
            $table->string('o_remarks');
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
        Schema::dropIfExists('operations');
    }
}
