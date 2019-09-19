<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('authorId')->unsigned();
            $table->integer('accountId')->unsigned(); // TODO: Extra column, need remove
            $table->integer('entityId')->unsigned();
            $table->text('text')->nullable();
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('updatedAt')->nullable();
        });

        Schema::table('comments', function ($table) {
            $table->foreign('authorId')->references('id')->on('users');
            $table->foreign('accountId')->references('id')->on('accounts');
            $table->foreign('entityId')->references('id')->on('entities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
