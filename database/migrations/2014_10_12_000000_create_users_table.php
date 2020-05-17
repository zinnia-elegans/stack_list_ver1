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
            $table->increments('id');
            $table->string('name')->comment('表示名');
            $table->string('email')->nullable()->comment('email');
            $table->string('password')->nullable()->comment('ログインパスワード');

            $table->string('avatar')->nullable()->comment('twitteruアイコンのURL');
            $table->string('twitter_id')->unique()->nullable()->comment('twitterのID');
            $table->string('twitter_name')->nullable()->comment('twitter＠名前、変更できない方');

            $table->string('provider')->nullble();
            $table->string('provider_id')->nullable();
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
