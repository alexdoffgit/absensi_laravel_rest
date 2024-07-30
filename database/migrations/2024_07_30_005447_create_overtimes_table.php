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
        Schema::create('overtimes', function (Blueprint $table) {
            $table->integer('id', true)->primary();
            $table->integer('user_id')->nullable();
            $table->dateTime('start_time', 6)->nullable();
            $table->dateTime('end_time', 6)->nullable();
            $table->text('description')->nullable();
            $table->integer('approved_by')->nullable();
            $table->integer('approval_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime');
    }
};
