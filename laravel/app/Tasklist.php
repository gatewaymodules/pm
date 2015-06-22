<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasklist extends Model
{
    protected $guarded = [];

    protected $touches = ['project'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task')->orderBy('completed', 'asc')->orderBy('updated_at', 'desc');
        //return $this->hasMany('App\Task');
    }

}
