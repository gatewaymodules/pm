<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $guarded = [];

    protected $touches = ['tasklist'];

    public function due_at()
    {
        if ($this->due_at != "0000-00-00 00:00:00") {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->due_at)->diffForHumans();
        } else {
            return "";
        }
    }

    public function tasklist()
    {
        return $this->belongsTo('App\Tasklist');
    }

}
