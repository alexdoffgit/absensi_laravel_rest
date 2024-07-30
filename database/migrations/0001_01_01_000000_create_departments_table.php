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
        Schema::create('departments', function (Blueprint $table) {
            $table->integer('DEPTID', true)->primary();
            $table->tinyText('DEPTNAME');
            $table->integer('SUPDEPTID')->nullable();
            $table->double('InheritParentSch')->nullable();
            $table->double('InheritDeptSch')->nullable();
            $table->double('AutoSchPlan')->nullable();
            $table->double('InLate')->nullable();
            $table->double('OutEarly')->nullable();
            $table->double('InheritDeptRule')->nullable();
            $table->integer('MinAutoSchInterval')->nullable();
            $table->double('RegisterOT')->nullable();
            $table->integer('DefaultSchId')->nullable();
            $table->double('ATT')->nullable();
            $table->double('Holiday')->nullable();
            $table->double('OverTime')->nullable();
            $table->double('InheritDeptSchClass')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
