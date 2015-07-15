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
     * Used to filter tasks belonging to self (but which may also be assigned to others)
     *
     * Order is very specific, current user logged in first, and then user who want to compare
     *
     * @param $query
     * @param $userIds Array
     * @internal param $user_id
     */
    public function scopeWhereAssignedToUsers($query, $userIds)
    {
        $query->whereIn('id', function ($query) use ($userIds)
        {
            $query->select('task_id')
                ->from('task_user')
                ->whereRaw('user_id = ' . $userIds[0] . ' AND '. $userIds[1]);
        });
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

    public function updated_at()
    {
        if ($this->updated_at != "0000-00-00 00:00:00") {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->diffForHumans();
        } else {
            return '';
        }
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
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->due_at, 'Africa/Johannesburg')->diffForHumans();
        } else {
            return '';
        }
    }

    public function tasklist()
    {
        return $this->belongsTo('App\Tasklist');
    }

}
