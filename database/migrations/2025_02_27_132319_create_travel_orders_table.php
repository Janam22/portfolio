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
        Schema::create('travel_orders', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('emp_id', 20);
            $table->date('from_date')->useCurrent();
            $table->date('to_date')->useCurrent();
            $table->string('travel_place', 255);
            $table->string('travel_mode', 255);
            $table->string('travel_order_status', 255)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_orders');
    }
};
