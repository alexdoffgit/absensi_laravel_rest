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
        Schema::create('deptseq', function (Blueprint $table) {
            $table->integer('DEPTID')->primary();
            $table->string('SEQ', '255');
            $table->double('DLEVEL')->nullable();
            $table->boolean('HaveChild')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deptseq');
    }
};
