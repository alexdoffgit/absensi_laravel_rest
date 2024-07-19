<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('userinfo', function (Blueprint $table) {
            $table->id('USERID');
            $table->string('Badgenumber', 255);
            $table->string('SSN', 255);
            $table->string('Name');
            $table->string('Gender', 255);
            $table->string('TITLE', 255);
            $table->string('PAGER', 255);
            $table->dateTime('BIRTHDAY', 6);
            $table->dateTime('HIREDDAY', 6);
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('street', 255);
            $table->string('CITY', 255);
            $table->string('STATE', 255);
            $table->string('ZIP', 255);
            $table->string('OPHONE', 255);
            $table->double('VERIFICATIONMETHOD');
            $table->integer('DEFAULTDEPTID');
            $table->integer('SECURITYFLAGS');
            $table->integer('ATT');
            $table->integer('INLATE');
            $table->integer('OUTEARLY');
            $table->integer('OVERTIME');
            $table->integer('SEP');
            $table->integer('HOLIDAY');
            $table->text('MINZU');
            $table->string('PASSWORD', 255);
            $table->integer('LUNCHDURATION');
            $table->string('MVERIFYPASS', 255);
            $table->string('PHOTO', 255);
            $table->text('Notes');
            $table->integer('privilege');
            $table->integer('InheritDeptSch');
            $table->integer('InheritDeptSchClass');
            $table->integer('AutoSchPlan');
            $table->integer('MinAutoSchInterval');
            $table->integer('RegisterOT');
            $table->integer('InheritDeptRule');
            $table->integer('EMPRIVILEGE');
            $table->string('CardNo', 255);
            $table->rememberToken();
            // $table->timestamps();
        });

        // Schema::create('password_reset_tokens', function (Blueprint $table) {
        //     $table->string('email')->primary();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('user_id')->nullable()->index();
            $table->foreign('user_id')->references('USERID')->on('userinfo');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        // Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
