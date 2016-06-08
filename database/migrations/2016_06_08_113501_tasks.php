<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->text('name');
            $table->integer('duration');
            $table->longText('date_jalon');
            $table->text('status');
            $table->integer('priority');
            $table->integer('project_id');
            $table->integer('parent_id');
            $table->timestamps(); // Creation the column "created_at" and "updated_at"
        });

        Schema::table('events', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('parent_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
