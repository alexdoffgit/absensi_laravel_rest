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
        Schema::create('user_sch', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('USERID')->nullable();
            $table->dateTime('COMETIME', 6)->nullable();
            $table->dateTime('LEAVETIME', 6)->nullable();
            $table->integer('OVERTIME')->nullable();
            $table->double('TYPE')->nullable();
            $table->double('FLAG')->nullable();
            $table->integer('SCHCLASSID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sch');
    }
};
