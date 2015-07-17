<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model {

    /**
     * @var array Added so that assigned to list can be submitted in HTML forms
     */
    protected $guarded = ['assigned_to'];

    /**
     * Returns a list of IDs used in HTML select multiple
     *
     * @return mixed
     */
    public function getUserIds() {
        return $this->users()->getRelatedIds()->toArray();
    }

    public function tasklists()
    {
        return $this->hasMany('App\Tasklist')->orderBy('updated_at', 'desc');
    }

    /**
     * http://laravel.com/docs/5.1/eloquent-relationships#many-to-many
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
