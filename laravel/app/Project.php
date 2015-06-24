<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $guarded = [];

//    public function save(array $options = array())
//    {
//        parent::save($options);
//        $project_id = DB::getPdo()->lastInsertId();
//        $user_id = Auth::user()->id;
//
//    }

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
        return $this->belongsToMany('App\Users');
    }

}
