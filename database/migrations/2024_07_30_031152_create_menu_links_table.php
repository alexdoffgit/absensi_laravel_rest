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
        Schema::create('menu_links', function (Blueprint $table) {
            $table->integer('id', true)->primary();
            $table->string('menu_path', 255)->nullable();
            $table->string('laravel_controller_class', 255)->nullable();
            $table->string('laravel_controller_method', 255)->nullable();
            $table->string('laravel_middleware', 255)->nullable();
            $table->string('http_method', 255)->nullable();
            $table->string('route_type', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_links');
    }
};
