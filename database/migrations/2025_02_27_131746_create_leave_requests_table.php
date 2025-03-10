<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('emp_id', 20);
            $table->string('leave_type', 255)->comment('sl = Sick Leave, el = Emergency Leave');
            $table->date('from_date')->useCurrent();
            $table->date('to_date')->useCurrent();
            $table->string('subject', 255);
            $table->string('reason_description', 255);
            $table->string('leave_status', 255)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
