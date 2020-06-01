<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->unique()->nullable()->comment('twitterのID');
            $table->string('name')->nullable()->comment('表示名');
            $table->string('screen_name')->nullable()->comment('アカウント名');
            $table->string('email')->nullable('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->comment('ログインパスワード');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}