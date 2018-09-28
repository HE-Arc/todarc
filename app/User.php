<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all of the post's comments.
     */
    public function projects()
    {
        return $this->morphMany('App\Project', 'owner');
    }

    /**
     * The labels that belong to the task.
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

    /**
     * The taks that belong to the label.
     */
    public function Organisations()
    {
        return $this->belongsToMany('App\Organisation');
    }
}
