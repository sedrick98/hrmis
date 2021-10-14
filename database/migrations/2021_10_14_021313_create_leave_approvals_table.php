<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_approvals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->int('leave_request_id');
            $table->int('approving_user_id')->nullable();

            $table->string('status');
            $table->string('approval_reason');
            $table->string('disapproval_reason');
            $table->string('paid_days');
            $table->string('unpaid_days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_approvals');
    }
}
