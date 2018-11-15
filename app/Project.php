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
    return $this->hasMany('App\Group');
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
   public function tasks($user = null)
   {
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
}
