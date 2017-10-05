<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->unsigned();
             $table->foreign('test_id')
                ->references('id')
                ->on('tests')
                ->onDelete('cascade');
                $table->integer('rate');
            $table->integer('user_id')->unsigned();
             $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->integer('votes_count')->default(0);
            $table->text('body');
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
        Schema::dropIfExists('test_comments');
    }
}
