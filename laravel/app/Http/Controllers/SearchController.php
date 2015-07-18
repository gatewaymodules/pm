<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Project;
use App\Tasklist;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Input;
use Redirect;
use Response;

class SearchController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function queryTasks()
    {
        $query = Input::get('name');
        $res = DB::select("select 'task' AS `type`, tasks.* from tasks where name like ? and completed<>1", ['%'.$query.'%']);
        return response()->json($res);
    }

    public function queryTasklists()
    {
        $query = Input::get('name');
        $res = DB::select("select 'tasklist' AS `type`, tasklists.* from tasklists where name like ?", ['%'.$query.'%']);
        return response()->json($res);
    }

    public function queryProjects()
    {
        $query = Input::get('name');
        $res = DB::select("select 'project' AS `type`, projects.* from projects where name like ?", ['%'.$query.'%']);
        return response()->json($res);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $query = Input::get('type');
        $auth_user_id = Auth::user()->id;
        $user = User::find($auth_user_id);
        switch ($query) {
            case 'task' :
                $task_id = Input::get('id');
                $tasks = User::find($auth_user_id)->tasks()->where('id', '=', $task_id)->get();
                break;
            case 'tasklist' :
                $tasklist_id = Input::get('id');
                $tasklist = Tasklist::find($tasklist_id);
                $project = $tasklist->project()->first();
                return view('tasklist.show', compact('project', 'tasklist'));
                break;
            case 'project' :
                $project_id = Input::get('id');
                $project = Project::find($project_id);
                $tasklists = User::find($auth_user_id)->tasklists()->where('project_id', '=', $project->id)->get();
                return view('project.show', compact('project', 'tasklists'));
                break;
            default:

                if (Auth::user()->hasRole('admin') && config('projectmanager.superusermode')) {
                    $tasks = User::find($auth_user_id)->tasks()->get();
                } else {
                    $userIds = array($auth_user_id, $auth_user_id);
                    $tasks = Task::WhereAssignedToUsers($userIds)
                        ->where('completed', '<>', 1)
                        ->get();
                }
        }
        return view('usertasks.index', compact('tasks', 'user', 'paginator'));
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
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
