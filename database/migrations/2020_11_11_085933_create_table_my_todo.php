<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMyTodo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_my_todo', function (Blueprint $table) {
            $table->id();
            $table->string('todo_topic');
            $table->string('todo_detail');
            $table->string('todo_place');
            $table->string('todo_alert');
            $table->string('delete_at');
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
        Schema::dropIfExists('table_my_todo');
    }
}
