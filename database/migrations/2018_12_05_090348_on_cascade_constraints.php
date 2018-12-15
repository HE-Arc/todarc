<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OnCascadeConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('task_user', function (Blueprint $table) {
        $table->dropForeign('task_user_task_id_foreign');
        $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
      });

      Schema::table('tasks', function (Blueprint $table) {
        $table->dropForeign('tasks_group_id_foreign');
        $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
      });

      Schema::table('label_task', function (Blueprint $table) {
        $table->dropForeign('label_task_label_id_foreign');
        $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');

        $table->dropForeign('label_task_task_id_foreign');
        $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
      });

      Schema::table('groups', function (Blueprint $table) {
        $table->dropForeign('groups_group_id_foreign');
        $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

        $table->dropForeign('groups_project_id_foreign');
        $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
      });

      Schema::table('labels', function (Blueprint $table) {
        $table->dropForeign('labels_project_id_foreign');
        $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        $table->foreign('task_id')->references('id')->on('tasks');
      });

      Schema::table('tasks', function (Blueprint $table) {
        $table->dropForeign('tasks_group_id_foreign');
        $table->foreign('group_id')->references('id')->on('groups');
      });

      Schema::table('label_task', function (Blueprint $table) {
        $table->dropForeign('label_task_label_id_foreign');

        $table->dropForeign('label_task_task_id_foreign');
        $table->foreign('task_id')->references('id')->on('tasks');
      });

      Schema::table('groups', function (Blueprint $table) {
        $table->dropForeign('groups_group_id_foreign');
        $table->foreign('group_id')->references('id')->on('groups');

        $table->dropForeign('groups_project_id_foreign');
        $table->foreign('project_id')->references('id')->on('projects');
      });

      Schema::table('labels', function (Blueprint $table) {
        $table->dropForeign('labels_project_id_foreign');
        $table->foreign('project_id')->references('id')->on('projects');
      });
    }
}
