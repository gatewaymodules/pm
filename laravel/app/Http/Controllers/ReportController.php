<?php

// For troubleshooting queries, don't use dd(DB::getQueryLog());
// Use ->toSql() instead of ->get();

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
    public function index(Project $project, Tasklist $tasklist)
    {
        $yesterday = \Carbon\Carbon::now()->subDays(0);
        $max_mru_items = 15;
        $max_items = 3;

        $mostRecentProjects = User::find(Auth::user()->id)
            ->projects()
            ->orderBy('updated_at','DESC')
            ->take($max_mru_items)
            ->get();

        $overdueHighPriorityTasks = User::find(Auth::user()->id)
            ->tasks()
            ->where('completed', '<>', 1)
            ->where('priority', '=', 1)
            ->where('due_at', '<=', $yesterday)
            ->where('due_at', '<>', '0000-00-00 00:00:00')
            ->orderBy('due_at', 'ASC')
            ->take($max_items)
            ->get();

        $overdueTasks = User::find(Auth::user()->id)
            ->tasks()
            ->where('completed', '<>', 1)
            ->where('priority', '=', 0)
            ->where('due_at', '<=', $yesterday)
            ->where('due_at', '<>', '0000-00-00 00:00:00')
            ->orderBy('due_at', 'ASC')
            ->take($max_items)
            ->get();

        $user = Auth::user();
        $user_id = $user->id;

        $overdueHighPriorityTasksOther = Task::whereNotRelatedToUser($user_id)
            ->where('completed', '<>', 1)
            ->where('priority', '=', 1)
            ->where('due_at', '<=', $yesterday)
            ->where('due_at', '<>', '0000-00-00 00:00:00')
            ->orderBy('due_at', 'ASC')
            ->take($max_items)
            ->get();

        $overdueTasksOther = Task::whereNotRelatedToUser($user_id)
            ->where('completed', '<>', 1)
            ->where('priority', '=', 0)
            ->where('due_at', '<=', $yesterday)
            ->where('due_at', '<>', '0000-00-00 00:00:00')
            ->orderBy('due_at', 'ASC')
            ->take($max_items)
            ->get();

        $oldestTasks = User::find(Auth::user()->id)
            ->tasks()
            ->where('completed', '<>', 1)
            ->orderBy('created_at', 'ASC')
            ->take($max_items)
            ->get();

        // Graphs

        $workBreakdown = DB::table('tasks')
            ->select(DB::raw('count(id),creator_id'))
            ->groupBy(DB::raw('creator_id'))
            ->get();

        //dd($workBreakdown);

        $completedTasks = DB::table('tasks')
            ->select(DB::raw('DATE(completed_at) as completedDate'), DB::raw('count(id) as completedTask'))
            ->orWhereNotNull('completed_at')
            ->groupBy(DB::raw('DATE(completed_at)'))
            ->orderBy('completed_at', 'DESC')
            ->get();

        $updatedTasks = DB::table('tasks')
            ->select(DB::raw('DATE(updated_at) as updatedDate'), DB::raw('count(id) as updatedTask'))
            ->whereRaw('updated_at <> created_at')
            ->groupBy(DB::raw('DATE(updated_at)'))
            ->orderBy('updated_at', 'DESC')
            ->get();

        $createdTasks = DB::table('tasks')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(id) as total'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('created_at', 'DESC')
            ->get();

        return View::make('admin.reports.daily')
            ->with([
                    'mostRecentProjects' => $mostRecentProjects,

                    'overdueHighPriorityTasks' => $overdueHighPriorityTasks,
                    'overdueTasks' => $overdueTasks,
                    'overdueHighPriorityTasksOther' => $overdueHighPriorityTasksOther,
                    'overdueTasksOther' => $overdueTasksOther,
                    'oldestTasks' => $oldestTasks,

                    'completedDates' => array_pluck($completedTasks, 'completedDate'),
                    'completedTasks' => array_pluck($completedTasks, 'completedTask'),
                    'updatedDates' => array_pluck($updatedTasks, 'updatedDate'),
                    'updatedTasks' => array_pluck($updatedTasks, 'updatedTask'),
                    'dates' => array_pluck($createdTasks, 'date'),
                    'totals' => array_pluck($createdTasks, 'total'),

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
