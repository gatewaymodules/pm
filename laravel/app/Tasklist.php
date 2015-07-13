<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasklist extends Model
{
    
    protected $guarded = [];

    protected $touches = ['project'];

    public function hasPriorityTasks() {
        return $this->hasMany('App\Task')->where('completed', 0)->where('priority', 1)->count();
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task')->where('completed', '<>', '1')->orderBy('completed', 'asc')->orderBy('updated_at', 'desc');
    }

}
