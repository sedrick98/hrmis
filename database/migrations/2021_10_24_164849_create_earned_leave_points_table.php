<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarnedLeavePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earned_leave_points', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['vacation', 'sick']);
            $table->integer('user_id');
            $table->integer('month');
            $table->integer('year');
            $table->float('points', 4, 2);
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
        Schema::dropIfExists('earned_leave_points');
    }
}
