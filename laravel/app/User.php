<?php

namespace App;

use DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;
    use EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'username', 'avatar', 'provider_id', 'provider', 'phone'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];



//      This was supposed to help for getting Unassigned user tasks
//        $highPriorityTasksUnassigned = Auth::user()->availableTasks();

//    // User model
//    public function availableTasks()
//    {
//        $ids = DB::table('task_user')->where('user_id', '=', $this->id)->lists('user_id');
//        return \App\Task::whereNotIn('id', $ids)->get();
//    }

    public function tasks() {
        return $this->belongsToMany('App\Task');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project')->orderBy('updated_at', 'desc');
    }

}
