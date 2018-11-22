<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Project extends Model
{
  /**
  * Get the label that owns the project.
  */
  public function labels()
  {
    return $this->hasMany('App\Label');
  }


  /**
  * The labels that belong to the task.
  */
  public function groups()
  {
    return $this->hasMany('App\Group')->orderBy('order');
  }

  /**
  * Get all of the owning commentable models.
  */
  public function Owner()
  {
    return $this->morphTo();
  }

  /**
   * get all tasks of the project
   */
  public function tasks()
  {
    return $this->hasManyThrough('App\Task', 'App\Group')->orderBy('order');
  }

  /**
   * get all task of the project for a user
   */
  public function tasksUser($user = null)
  {
    //TODO Function renamed where it was used
    $tasks = new Collection();

    foreach ($this->groups as $group)
    {
      $tasks = $tasks->merge($group->getTasksGroupAndChildren($user));
    }

    return $tasks;
  }

   /**
    * get all tasks name in a collection
    */
   public function tasksName($user = null)
   {
     $tasksName = new Collection();
     $tasks = $this->tasks($user);

     foreach ($tasks as $task)
     {
       $tasksName->push($task->name);
     }

     return $tasksName;
   }

   public function tasksNameJson($user = null)
   {
     return $this->tasksName($user)->toJson();
   }

   public function getUrlAttribute()
  {
    return action('ProjectController@show', ['id' => $this->id]);
  }

   protected $appends = ['url'];
}
