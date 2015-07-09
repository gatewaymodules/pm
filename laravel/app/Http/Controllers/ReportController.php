<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Tasklist;
use App\Task;
use Illuminate\Support\Facades\Auth;
use PDO;
use View;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Project $project, Tasklist $tasklist)
    {
        $yesterday = \Carbon\Carbon::now()->subDays(0);

        $highPriorityTasks = User::find(Auth::user()->id)
            ->tasks()
            ->where('completed', '<>', 1)
            ->where('due_at', '<=', $yesterday)
            ->where('due_at', '<>', '0000-00-00 00:00:00')
            ->orderBy('due_at', 'ASC')
            ->get();

        $user_id = Auth::user()->id;
        $highPriorityTasksUnassigned = Task::whereNotRelatedToUser($user_id)
            ->where('completed', '<>', 1)
            ->where('due_at', '<=', $yesterday)
            ->where('due_at', '<>', '0000-00-00 00:00:00')
            ->orderBy('due_at', 'ASC')
            ->get();

//        // TODO Stack Overflow Create a filter so that tasks which are not assigned to is listed but no which belongs to me
//        $highPriorityTasksUnassigned = Task::where('completed', '<>', 1)
//            ->where('due_at', '<=', $yesterday)
//            ->where('due_at', '<>', '0000-00-00 00:00:00')
//            ->orderBy('due_at', 'ASC')
//            ->get();

        // Graphs

        $completedTasks = DB::table('tasks')
            ->select(DB::raw('DATE(completed_at) as completedDate'), DB::raw('count(id) as completedTask'))
            ->orWhereNotNull('completed_at')
            ->groupBy(DB::raw('DATE(completed_at)'))
            ->orderBy('completed_at', 'DESC')
            ->get();
        //dd(DB::getQueryLog());

        $updatedTasks = DB::table('tasks')
            ->select(DB::raw('DATE(updated_at) as updatedDate'), DB::raw('count(id) as updatedTask'))
            ->groupBy(DB::raw('DATE(updated_at)'))
            ->orderBy('updated_at', 'DESC')
            ->get();

        $createdTasks = DB::table('tasks')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(id) as total'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('created_at', 'DESC')
            ->get();

        //$user = User::Auth();
        $user = User::find(Auth::user()->id);

        return View::make('admin.reports.daily')
            ->with([
                    'completedDates' => array_pluck($completedTasks, 'completedDate'),
                    'completedTasks' => array_pluck($completedTasks, 'completedTask'),
                    'updatedDates' => array_pluck($updatedTasks, 'updatedDate'),
                    'updatedTasks' => array_pluck($updatedTasks, 'updatedTask'),
                    'dates' => array_pluck($createdTasks, 'date'),
                    'totals' => array_pluck($createdTasks, 'total'),

                    'highPriorityTasks' => $highPriorityTasks,
                    'highPriorityTasksUnassigned' => $highPriorityTasksUnassigned,
                    'project' => $project,
                    'tasklist' => $tasklist,
                    'user' => $user
                ]
            );
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
