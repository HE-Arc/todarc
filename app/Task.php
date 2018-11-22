<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'group_id', 'from_date', 'until_date', 'description', 'order', 'done'];

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
        return $this->belongsTo('App\Group');
    }

    /**
     * The labels that belong to the task.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
