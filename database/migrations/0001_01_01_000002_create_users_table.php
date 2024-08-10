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
            $table->integer('USERID', true)->primary();
            $table->tinyText('Badgenumber')->nullable();
            $table->tinyText('SSN')->nullable();
            $table->string('fullname', 255)->nullable();
            $table->tinyText('Gender')->nullable();
            $table->tinyText('TITLE')->nullable();
            $table->tinyText('PAGER')->nullable();
            $table->dateTime('BIRTHDAY', 6)->nullable();
            $table->dateTime('HIREDDAY', 6)->nullable();
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->tinyText('street')->nullable();
            $table->tinyText('CITY')->nullable();
            $table->tinyText('STATE')->nullable();
            $table->tinyText('ZIP')->nullable();
            $table->tinyText('FPHONE')->nullable();
            $table->tinyText('OPHONE')->nullable();
            $table->double('VERIFICATIONMETHOD')->nullable();
            $table->integer('DEFAULTDEPTID')->nullable();
            $table->integer('SECURITYFLAGS')->nullable();
            $table->integer('ATT')->nullable();
            $table->integer('INLATE')->nullable();
            $table->integer('OUTEARLY')->nullable();
            $table->integer('OVERTIME')->nullable();
            $table->integer('SEP')->nullable();
            $table->integer('HOLIDAY')->nullable();
            $table->text('MINZU')->nullable();
            $table->string('password', 255)->nullable();
            $table->integer('LUNCHDURATION')->nullable();
            $table->tinyText('MVERIFYPASS')->nullable();
            $table->tinyText('PHOTO')->nullable();
            $table->text('Notes')->nullable();
            $table->integer('privilege')->nullable();
            $table->integer('InheritDeptSch')->nullable();
            $table->integer('InheritDeptSchClass')->nullable();
            $table->integer('AutoSchPlan')->nullable();
            $table->integer('MinAutoSchInterval')->nullable();
            $table->integer('RegisterOT')->nullable();
            $table->integer('InheritDeptRule')->nullable();
            $table->integer('EMPRIVILEGE')->nullable();
            $table->tinyText('CardNo')->nullable();
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
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('userinfo');
        // Schema::dropIfExists('password_reset_tokens');
    }
};
