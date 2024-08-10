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
        Schema::create('schclass', function (Blueprint $table) {
            $table->integer('schclassid')->primary()->autoIncrement();
            $table->string('SCHNAME', 50);
            $table->time('STARTTIME')->nullable();
            $table->time('ENDTIME')->nullable();
            $table->string('LATEMINUTES', 50)->nullable();
            $table->string('EARLYMINUTES', 50)->nullable();
            $table->integer('CHECKIN')->nullable();
            $table->integer('CHECKOUT')->nullable();
            $table->string('CHECKINTIME1', 50)->nullable();
            $table->string('CHECKINTIME2', 50)->nullable();
            $table->string('CHECKOUTTIME1', 50)->nullable();
            $table->string('CHECKOUTTIME2', 50)->nullable();
            $table->integer('COLOR')->nullable();
            $table->double('AUTOBIND')->nullable();
            $table->double('WorkDay')->nullable();
            $table->string('SensorID', 50)->nullable();
            $table->double('WorkMins')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schclass');
    }
};
