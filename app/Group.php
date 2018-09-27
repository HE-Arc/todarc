<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The labels that belong to the task.
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    /**
     * The labels that belong to the task.
     */
    public function groups()
    {
        return $this->hasMany('App\Group');
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
}
