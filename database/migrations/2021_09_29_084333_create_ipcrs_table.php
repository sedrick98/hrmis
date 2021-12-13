<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpcrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipcrs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('employee')->unsigned();
            $table->foreign('employee')->references('emp_id')->on('employees');
            $table->string('duration_1');
            $table->string('duration_2');
            $table->string('year');
            $table->string('status');
            $table->integer('a_1')->unsigned();
            $table->string('d_1');
            $table->integer('a_2')->unsigned();
            $table->string('d_2');
            $table->integer('a_3')->unsigned();
            $table->string('comment');
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
        Schema::dropIfExists('ipcrs');
    }
}
