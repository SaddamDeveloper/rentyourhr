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
            $table->string('name', 90)->nullable();
            $table->string('email', 90)->unique()->nullable();
            $table->string('mobile', 16)->unique();
            $table->string('user_code')->unique();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->string('company_name', 191)->nullable();
            $table->boolean('email_verified')->default(0);
            $table->boolean('mobile_verified')->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('is_complete')->default(0);
            $table->string('token')->nullable();
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
