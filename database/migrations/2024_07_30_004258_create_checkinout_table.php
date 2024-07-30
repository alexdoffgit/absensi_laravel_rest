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
        Schema::create('checkinout', function (Blueprint $table) {
            $table->integer('id', true)->primary();
            $table->integer('USERID')->nullable();
            $table->dateTime('CHECKTIME', 6)->nullable();
            $table->string('CHECKTYPE')->nullable();
            $table->integer('VERIFYCODE')->nullable();
            $table->string('SENSORID')->nullable();
            $table->integer('WorkCode')->nullable();
            $table->tinyText('sn')->nullable();
            $table->double('UserExtFmt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkinout');
    }
};
