<?php

use Illuminate\Support\Facades\Schema;
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
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->integer('accountId')->unsigned();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('avatarUrl')->nullable();
            $table->integer('userRoleId')->unsigned();
            $table->timestamp('lastLoginAt')->nullable()->default(null);
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('updatedAt')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('accountId')->references('id')->on('accounts');
            $table->foreign('userRoleId')->references('id')->on('userRoles');
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
