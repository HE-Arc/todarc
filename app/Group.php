<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','order', 'group_id'];

    /**
     * The labels that belong to the task.
     */
    public function tasks()
    {
        return $this->hasMany('App\Task')->orderBy('order');
    }

    /**
     * The labels that belong to the task.
     */
    public function groups()
    {
        return $this->hasMany('App\Group')->orderBy('order');
    }

    /**
     * The labels that belong to the task.
     */
    public function group()
    {
        return $this->belongsTo('App\Group');
    }


    /**
     * The labels that belong to the task.
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * get all the task of the group and his children
     * @return Collection<Task>
     */
    public function getTasksGroupAndChildren($user = null, $tasks = null)
    {
      if($tasks === null)
      {
        $tasks = new Collection();
      }
      
      if($user === null)
      {
        $tasks = $tasks->merge($this->tasks);
      }
      else
      {
        foreach ($this->tasks as $task)
        {
          if($task->users->contains($user))
          {
            $tasks->push($task);
          }
        }
      }

      foreach ($this->groups as $group)
      {
        $tasks = $tasks->merge($group->getTasksGroupAndChildren($user, $tasks));
      }

      return $tasks;
    }
}
