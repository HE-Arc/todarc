<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
  public function project_owner()
  {
    return $this->morphTo();
  }
}
