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
            $table->string('name')->comment('表示名');
            $table->string('screen_name')->nullable()->comment('アカウント名');
            $table->string('email')->nullable('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->comment('ログインパスワード');
            $table->string('description')->nullable()->comment('自己紹介');
            $table->string('avatar')->nullable()->comment('twitterアイコン');
            $table->string('profile_image')->nullable()->comment('プロフィール画像');
            $table->string('twitter_id')->unique()->nullable()->comment('twitterのID');
            $table->string('twitter_name')->nullable()->comment('twitter＠名前、変更できない方');
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