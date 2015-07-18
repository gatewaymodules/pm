<?php

namespace App\Http\Controllers;

use App\Project;
use App\Tasklist;
use Input;
use App\Task;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsertasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

//        $query = Input::get('type');
//        dd($query);

//        $auth_user_id = Auth::user()->id;
//
//        $user = User::find($auth_user_id);
//
//        $tasks = User::find($auth_user_id)->tasks()->get();
//        return view('usertasks.index', compact('tasks', 'user', 'paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * The SQL that produces search results is
     * select * from `tasks`
     * inner join `task_user` on `tasks`.`id` = `task_user`.`task_id`
     * where `task_user`.`user_id` = 16 and `id` = 20;
     *
     * @param $id
     * @return Response
     * @internal param $user
     * @internal param int $id
     */
    public function show($id)
    {
        $user = User::find($id);
        $auth_user_id = Auth::user()->id;

        if (Auth::user()->hasRole('admin') && config('projectmanager.superusermode')) {
            $tasks = User::find($id)->tasks()->get();
        } else {
            $userIds = array($auth_user_id, $id);
            $tasks = Task::WhereAssignedToUsers($userIds)
                ->where('completed', '<>', 1)
                ->get();
        }
        return view('usertasks.index', compact('tasks', 'user', 'paginator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
