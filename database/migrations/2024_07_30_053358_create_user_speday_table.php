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
        Schema::create('user_speday', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('user_id')->nullable();
            $table->text('yuanying')->nullable();
            $table->dateTime('startspecday', 6)->nullable();
            $table->dateTime('endspecday', 6)->nullable();
            $table->integer('dateid')->nullable();
            $table->dateTime('date', 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_speday');
    }
};
