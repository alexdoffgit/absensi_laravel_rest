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
        Schema::create('schedule_proposals', function (Blueprint $table) {
            $table->integer('id', true)->primary();
            $table->integer('schedule_applicant')->nullable();
            $table->string('schedule_name')->nullable();
            $table->dateTime('starttime', 6)->nullable();
            $table->dateTime('endtime', 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_proposals');
    }
};
