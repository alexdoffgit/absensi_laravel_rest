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
        Schema::create('menu_sequences', function (Blueprint $table) {
            $table->integer('id', true)->primary();
            $table->integer('menu_link_id')->nullable();
            $table->string('menu_name', 255)->nullable();
            $table->string('menu_name_lang_ID', 255)->nullable();
            $table->integer('menu_level')->nullable();
            $table->integer('parent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_sequences');
    }
};
