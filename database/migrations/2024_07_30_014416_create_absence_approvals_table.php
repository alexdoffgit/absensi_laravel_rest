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
        Schema::create('absence_approvals', function (Blueprint $table) {
            $table->integer('id', true)->primary();
            $table->integer('absence_id')->nullable();
            $table->integer('approver_user_id')->nullable();
            $table->string('status')->default('pending');
            $table->string('status_lang_id')->default('menunggu');
            $table->timestamps(6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absence_approval');
    }
};
