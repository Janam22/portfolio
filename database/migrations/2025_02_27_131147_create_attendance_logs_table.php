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
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('emp_id', 20);
            $table->dateTime('checkin_time')->useCurrent();
            $table->string('ci_lat', 191);
            $table->string('ci_lon', 191);
            $table->dateTime('checkout_time')->nullable();
            $table->string('co_lat', 191)->nullable();
            $table->string('co_lon', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');
    }
};
