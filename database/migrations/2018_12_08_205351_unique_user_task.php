<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UniqueUserTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('task_user', function (Blueprint $table) {
          $table->unique(['task_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('task_user', function (Blueprint $table) {
        $table->dropForeign('task_user_task_id_foreign');
        $table->dropForeign('task_user_user_id_foreign');

        $table->dropUnique('task_user_task_id_user_id_unique');

        $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users');
      });
    }
}
