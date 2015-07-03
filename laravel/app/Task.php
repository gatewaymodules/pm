<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Cascade updated_at changes up to the parent level
     *
     * @var array
     */
    protected $touches = ['tasklist'];

    /**
     * @var array Added so that assigned to list can be submitted in HTML forms
     */
    protected $guarded = ['assigned_to'];

//    public function getDueAtAttribute($value) {
//        return $value == "0000-00-00 00:00:00" ? "" : $value;
//    }

    /**
     * Returns a list of IDs used in HTML select multiple
     *
     * @return mixed
     */
    public function getUserIds()
    {
        return $this->users()->getRelatedIds()->toArray();
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    // TODO Consider renaming to camel case
    public function due_at()
    {
        if ($this->due_at != "0000-00-00 00:00:00") {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->due_at)->diffForHumans();
        } else {
            return '';
        }
    }

    public function tasklist()
    {
        return $this->belongsTo('App\Tasklist');
    }

}
