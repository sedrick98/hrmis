<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceForwardedLeavePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_forwarded_leave_points', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('hr_id')->references('id')->on('users');
            $table->integer('minutes');
            $table->integer('hours');
            $table->datetime('date');
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
        Schema::dropIfExists('balance_forwarded_leave_points');
}
}
