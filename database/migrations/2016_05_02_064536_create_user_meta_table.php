<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meta', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->bigInteger('ZUserId');
            $table->string('FirstName', 100)->nullable();
            $table->string('LastName', 100)->nullable();
            $table->date('BirthDate')->nullable();

            $table->timestamps();
            $table->foreign('ZUserId')->references('Id')->on('users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_meta', function (Blueprint $table) {
            $table->dropForeign('user_meta_zuserid_foreign');
        });
        Schema::drop('user_meta');
    }
}
