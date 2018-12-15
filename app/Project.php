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
  * get all tasks name in a collection
  */
  public function tasksName()
  {
    $tasksName = new Collection();
    foreach ($this->tasks as $task)
    {
      $tasksName->push($task->name);
    }
    return $tasksName;
  }

  public function getUrlAttribute()
  {
    return action('ProjectController@show', ['id' => $this->id]);
  }

   protected $appends = ['url'];
}
