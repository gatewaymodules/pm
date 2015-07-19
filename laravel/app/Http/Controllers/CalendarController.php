<?php

namespace App\Http\Controllers;

use App\Project;
use Input;
use App\EventModel;
use App\Tasklist;
use MaddHatter\LaravelFullcalendar\Calendar;

use App\Http\Requests;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\View\View
     * @internal param Tasklist $tasklist
     */
    public function index()
    {
        $events = [];

        $tasklist = Tasklist::find(Input::Get('tasklist'));
        $project = Project::find(Input::Get('project'));
        foreach ($tasklist->tasks as $task) {
            if ($task->due_at <> '0000-00-00 00:00:00') {
                $events[] = Calendar::event(
                    $task->name,
                    false,
                    $task->due_at,
                    $task->due_at,
                    0
                );
            }
        }

        $eloquentEvent = EventModel::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event

        $calendar = \Calendar::addEvents($events)//add an array with addEvents
        ->addEvent($eloquentEvent, [ //set custom color fo this event
            'color' => '#800',
        ])->setOptions([ //set fullcalendar options
            'firstDay' => 1
        ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            //'viewRender' => 'function() { alert("Callbacks!");}'
        ]);

        return view('calendar.index', compact('calendar', 'project', 'tasklist'));
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
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
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
