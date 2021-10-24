<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_request_approvals', function (Blueprint $table) {
            $table->id();
            $table->integer('leave_request_id');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->string('approver')->nullable();
            $table->string('approver_id')->nullable();
            $table->string('approval_type');
            $table->string('action_date')->nullable();
            $table->text('reason')->nullable();
            $table->string('designated_role');
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
        Schema::dropIfExists('leave_request_approvals');
    }
}
