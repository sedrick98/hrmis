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
            $table->integer('ipcr')->unsigned();
            $table->foreign('ipcr')->references('ipcr_id')->on('ipcrs');
            $table->string('output');
            $table->string('success_indicator');
            $table->string('actual_accomplishment');
            $table->integer('quality')->unsigned();
            $table->integer('efficiency')->unsigned();
            $table->integer('timeliness')->unsigned();
            $table->integer('average')->unsigned();
            $table->string('remarks');
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
