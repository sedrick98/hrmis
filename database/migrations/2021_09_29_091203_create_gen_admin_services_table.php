<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenAdminServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_admin_services', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('ipcrs');
            $table->string('g_output');
            $table->string('g_success_indicator');
            $table->string('g_actual_accomplishment');
            $table->integer('g_quality')->unsigned();
            $table->integer('g_efficiency')->unsigned();
            $table->integer('g_timeliness')->unsigned();
            $table->integer('g_average')->unsigned();
            $table->string('g_remarks');
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
        Schema::dropIfExists('gen_admin_services');
    }
}
