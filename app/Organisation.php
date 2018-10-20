<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    /**
     * The taks that belong to the label.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }


    /**
     * Get all of the post's comments.
     */
    public function projects()
    {
        return $this->morphMany('App\Project', 'owner');
    }

}
