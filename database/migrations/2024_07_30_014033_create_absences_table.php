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
        Schema::create('absences', function (Blueprint $table) {
            $table->integer('id', true)->primary();
            $table->integer('user_id')->nullable();
            $table->dateTime('submission_date', 6);
            $table->dateTime('date_start', 6);
            $table->dateTime('date_end', 6);
            $table->text('reason')->nullable();
            $table->string('supporting_document', 255)->nullable();
            $table->integer('leaveclass_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absence');
    }
};
