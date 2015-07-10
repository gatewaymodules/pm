<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function created_at()
    {
        if ($this->created_at != "0000-00-00 00:00:00") {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans();
        } else {
            return '';
        }
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function task() {
        return $this->belongsTo('App\Task');
    }

}
