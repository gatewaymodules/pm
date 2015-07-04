<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Tasklist;
use App\Task;
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

        $highPriorityTasks = Task::where('priority', '1')
            ->where('due_at', '<=', $yesterday)
            ->get();

        $updatedTasks = DB::table('tasks')
            ->select(DB::raw('DATE(updated_at) as updatedDate'), DB::raw('count(id) as updatedTask'))
            ->groupBy(DB::raw('DATE(updated_at)'))
            ->get();

        $createdTasks = DB::table('tasks')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(id) as total'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        return View::make('admin.reports.daily')
            ->with([
                'updatedDates' => array_pluck($updatedTasks, 'updatedDate'),
                'updatedTasks' => array_pluck($updatedTasks, 'updatedTask'),
                'dates' => array_pluck($createdTasks, 'date'),
                'totals' => array_pluck($createdTasks, 'total'),
                    'highPriorityTasks' => $highPriorityTasks,
                    'project' => $project,
                    'tasklist' => $tasklist,
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
