<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $guarded = [];

    public function tasklists()
    {
        return $this->hasMany('App\Tasklist')->orderBy('updated_at', 'desc');
    }

}
