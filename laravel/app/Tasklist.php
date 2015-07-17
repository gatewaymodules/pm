<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasklist extends Model
{

    /**
     * @var array Added so that assigned to list can be submitted in HTML forms
     */
    protected $guarded = ['assigned_to'];

    protected $touches = ['project'];

    /**
     * http://laravel.com/docs/5.1/eloquent-relationships#many-to-many
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Returns a list of IDs used in HTML select multiple
     *
     * @return mixed
     */
    public function getUserIds() {
        return $this->users()->getRelatedIds()->toArray();
    }

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
