<?php

namespace App\Http\Controllers;

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
        $user_id = Auth::user()->id;
        $tasks = User::find($user_id)->tasks()->get();
        return view('usertasks.index', compact('tasks', 'paginator'));
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
     * @param $user
     * @return Response
     * @internal param int $id
     */
    public function show($id)
    {
        $user = User::find($id);

        $this_user_id = Auth::user()->id;

        $userIds = array($this_user_id, $id);

        $tasks = Task::WhereAssignedToUsers($userIds)
            ->where('completed', '<>', 1)
            ->get();




//        $tasks = Task::WhereAssignedToUsers($userIds)
//            ->where('completed', '<>', 1)
//            ->toSql();
//
//        dd($tasks);

        //$tasks = User::find($id)->tasks()->get();

        return view('usertasks.index', compact('tasks', 'user', 'paginator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
