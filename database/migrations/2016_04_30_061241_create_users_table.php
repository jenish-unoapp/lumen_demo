<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('Id');
            $table->string('Email', 50)->unique();
            $table->string('Password', 100);
            $table->enum('Type', array('admin', 'user', 'poc'))->default('user');
            $table->string('ForgotPasswordToken', 50)->nullable();
            $table->dateTime('TokenExpireAt')->nullable();
            
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
        Schema::drop('users');
    }
}
