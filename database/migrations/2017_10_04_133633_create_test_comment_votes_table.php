<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestCommentVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_comment_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comment_id')->unsigned();
             $table->foreign('comment_id')
                ->references('id')
                ->on('test_comments')
                ->onDelete('cascade');
                $table->integer('rate');
            $table->integer('user_id')->unsigned();
             $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('test_comment_votes');
    }
}
