<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $guarded = [];

    public function tasklists()
    {
        return $this->hasMany('App\Tasklist')->orderBy('updated_at', 'desc');
    }

    /**
     * http://laravel.com/docs/5.1/eloquent-relationships#many-to-many
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

}
