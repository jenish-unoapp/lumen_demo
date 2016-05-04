<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_tokens', function (Blueprint $table) {
            $table->uuid('Id');
            $table->bigInteger('UserId');
            $table->text('Data');
            $table->dateTime('ExpireAt');

            $table->timestamps();
            $table->foreign('UserId')->references('Id')->on('users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auth_tokens', function (Blueprint $table) {
            $table->dropForeign('auth_tokens_userid_foreign');
        });
        Schema::drop('auth_tokens');
    }
}
