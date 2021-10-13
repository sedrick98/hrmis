<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->references('id')->on('users');

            $table->string('leave_type');

            $table->string('vacation_addl_location')->nullable();
            $table->string('vacation_addl_specify_country')->nullable();
            $table->string('vacation_addl_vacation_reason')->nullable();

            $table->string('sick_leave_addl_type')->nullable();
            $table->string('sick_leave_addl_reason')->nullable();

            $table->string('special_leave_addl_illness')->nullable();

            $table->string('study_leave_addl_reason')->nullable();

            $table->string('other_leave_addl_reason')->nullable();
            $table->string('other_leave_addl_reason_type')->nullable();

            $table->date('start_date');
            $table->date('end_date');
            $table->integer('number_of_days');
            $table->string('commutation');

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
        Schema::dropIfExists('leave_requests');
    }
}
