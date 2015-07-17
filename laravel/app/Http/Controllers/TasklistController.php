<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Input;
use Redirect;
use App\Project;
use App\Tasklist;
use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;

class TasklistController extends Controller {

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $rules = [
        'name' => ['required', 'min:3'],
        'slug' => ['required'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Project $project
     * @return Response
     */
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Project $project
     * @return Response
     */
    public function index(Project $project)
    {
        // TODO Not ever used
        //return view('tasklist.index', compact('tasklists'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Project $project
     * @return Response
     */
    public function create(Project $project)
    {
        return view('tasklist.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Project $project
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Project $project, Request $request)
    {
        $this->validate($request, $this->rules);

        $input = Input::all();
        $input['project_id'] = $project->id;
        $tasklist = Tasklist::create( $input );

        $tasklist_id = DB::getPdo()->lastInsertId();

        $assigned_to = Input::get('assigned_to');

        // Only sync if assigned_to multi select had some data
        if ($assigned_to) {
            $tasklist->users()->sync($assigned_to);
        } else { // If no users are selected to the assigned list, assign the logged in user
            $user = Auth::user();
            $user->tasklists()->attach($tasklist_id);
        }

        return Redirect::route('project.show', $project->slug)->with('Task list created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @param Tasklist $tasklist
     * @param Task $task
     * @return Response
     * @internal param Task $task
     */
    public function show(Project $project, Tasklist $tasklist, Task $task)
    {
        // TODO In this view I would like to return by created at, but I don't know how. StackOverflow  opportunity.
        return view('tasklist.show', compact('project', 'tasklist', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @param Tasklist $tasklist
     * @return Response
     * @internal param Task $task
     */
    public function edit(Project $project, Tasklist $tasklist)
    {
        $users = User::orderBy('name')->lists('name', 'id');
        $selected_users = $tasklist->users()->getRelatedIds()->toArray();
        return view('tasklist.edit', compact('project', 'tasklist', 'users', 'selected_users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Project $project
     * @param Tasklist $tasklist
     * @param \Illuminate\Http\Request $request
     * @return Response
     * @internal param Task $task
     */
    public function update(Project $project, Tasklist $tasklist, Request $request)
    {
        $this->validate($request, $this->rules);

        $input = array_except(Input::all(), '_method');
        $tasklist->update($input);

        $assigned_to = Input::get('assigned_to');
        // Only sync if assigned_to multi select had some data
        if ($assigned_to) {
            $tasklist->users()->sync($assigned_to);
        }

        return Redirect::route('project.tasklist.show', [$project->slug, $tasklist->slug])->with('message', 'Task list updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @param Tasklist $tasklist
     * @return Response
     * @internal param Task $task
     */
    public function destroy(Project $project, Tasklist $tasklist)
    {
        $tasklist->delete();

        return Redirect::route('project.show', $project->slug)->with('message', 'Task list deleted.');
    }

}
