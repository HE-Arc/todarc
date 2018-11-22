<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

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

    public function userNames()
    {
      $userNames = new Collection();

      foreach ($this->users as $user)
      {
        $userNames->push($user->name);
      }

      return $userNames;
    }

    public function getUrlAttribute()
   {
       return action('OrganisationController@show', ['id' => $this->id]);
   }

    protected $appends = ['url'];

}
