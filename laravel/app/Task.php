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
    protected $guarded = ['assigned_to', 'old_task_status'];

    public function comments() {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');;
    }

    /**
     * Used in Reports to show tasks that don't below to own
     *
     * @param $query
     * @param $user_id
     */
    public function scopeWhereNotRelatedToUser($query, $user_id)
    {
        $query->whereNotIn('id', function ($query) use ($user_id)
        {
            $query->select('task_id')
                ->from('task_user')
                ->where('user_id', '=', $user_id);
        });
    }

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

    public function created_at()
    {
        if ($this->created_at != "0000-00-00 00:00:00") {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans();
        } else {
            return '';
        }
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
