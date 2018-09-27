<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    /**
    * Get the project record associated with the project.
    */
    public function project()
    {
      return $this->belongsTo('App\Project');
    }

    /**
     * The taks that belong to the label.
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }
}
