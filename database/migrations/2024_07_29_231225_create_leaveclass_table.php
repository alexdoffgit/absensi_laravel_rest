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
        Schema::create('leaveclass', function (Blueprint $table) {
            $table->integer('LEAVEID')->primary();
            $table->tinyText('LEAVENAME');
            $table->double('MINUNIT')->nullable();
            $table->double('UNIT')->nullable();
            $table->double('REMAINDPROC')->nullable();
            $table->double('REMAINDCOUNT')->nullable();
            $table->tinyText('REPORTSYMBOL')->nullable();
            $table->double('DEDUCT')->nullable();
            $table->integer('COLOR')->nullable();
            $table->double('CLASSIFY')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaveclass');
    }
};
