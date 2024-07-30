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
        Schema::create('menu_links_roles', function (Blueprint $table) {
            $table->integer('id', true)->primary();
            $table->integer('menu_link_id')->nullable();
            $table->integer('dept_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->double('dlevel')->nullable();
            $table->boolean('all_can_access')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_links_roles');
    }
};
