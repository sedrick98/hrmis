<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInnovationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('innovations', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('ipcrs');
            $table->string('i_output');
            $table->string('i_success_indicator');
            $table->string('i_actual_accomplishment');
            $table->integer('i_quality')->unsigned();
            $table->integer('i_efficiency')->unsigned();
            $table->integer('i_timeliness')->unsigned();
            $table->integer('i_average')->unsigned();
            $table->string('i_remarks');
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
        Schema::dropIfExists('innovations');
    }
}
