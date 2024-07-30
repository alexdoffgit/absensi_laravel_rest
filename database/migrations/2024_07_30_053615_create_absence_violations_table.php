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
        Schema::create('absence_violations', function (Blueprint $table) {
            $table->integer('id', true)->primary();
            $table->dateTime('date_when', 6)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('leaveclass_id')->nullable();
            $table->text('more_info')->nullable();
            $table->dateTime('cometime', 6);
            $table->dateTime('leavetime', 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absence_violations');
    }
};
