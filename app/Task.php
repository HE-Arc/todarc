<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The labels that belong to the task.
     */
    public function labels()
    {
        return $this->belongsToMany('App\Label');
    }

    /**
     * The labels that belong to the task.
     */
    public function group()
    {
        return $this->belongsTo('App\Label');
    }

    /**
     * The labels that belong to the task.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
