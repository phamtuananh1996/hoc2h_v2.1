<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_user_id')->unsigned();
            $table->foreign('from_user_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');
            $table->integer('to_user_id')->unsigned();
            $table->foreign('to_user_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');
            $table->integer('state')->default(1);
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
        Schema::dropIfExists('conversations');
    }
}
