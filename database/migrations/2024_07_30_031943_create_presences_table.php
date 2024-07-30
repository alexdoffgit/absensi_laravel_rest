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
        Schema::create('presences', function (Blueprint $table) {
            $table->integer('id', true)->primary();
            $table->dateTime('work_date_start', 6)->nullable();
            $table->dateTime('checkin', 6)->nullable();
            $table->dateTime('checkout', 6)->nullable();
            $table->dateTime('break_start', 6)->nullable();
            $table->dateTime('break_end', 6)->nullable();
            $table->dateTime('checkin_schedule', 6)->nullable();
            $table->dateTime('checkout_schedule', 6)->nullable();
            $table->dateTime('break_start_schedule', 6)->nullable();
            $table->dateTime('break_end_schedule', 6)->nullable();
            $table->dateTime('work_date_end', 6)->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence');
    }
};
