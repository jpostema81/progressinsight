<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersLearningGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_learning_goals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('learning_goal_id')->nullable()->unsigned();
            $table->foreign('learning_goal_id')->references('id')->on('learning_goals')->onDelete('cascade');
            $table->bigInteger('progress_level_id')->nullable()->unsigned();
            $table->foreign('progress_level_id')->references('id')->on('progress_levels')->onDelete('cascade');
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
        Schema::dropIfExists('users_learning_goals');
    }
}
