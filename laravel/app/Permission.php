<?php namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    /**
     * The projects that have the permission
     */
    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }
}