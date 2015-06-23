<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    protected $guarded = [];

    protected $touches = ['tasklist'];

    public function tasklist()
    {
        return $this->belongsTo('App\Tasklist');
    }

}
