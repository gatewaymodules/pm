<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Project;
use App\Tasklist;
use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasklistsController extends Controller {

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
        'description' => ['required'],
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
        $tasklists = Tasklist::all();
        return view('tasklists.index', compact('project'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Project $project
     * @return Response
     */
    public function create(Project $project)
    {
        return view('tasklists.create', compact('project'));
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
        Tasklist::create( $input );

        return Redirect::route('projects.show', $project->slug)->with('Tasklist created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @param Tasklist $tasklist
     * @return Response
     * @internal param Task $task
     */
    public function show(Project $project, Tasklist $tasklist)
    {
        return view('tasklists.show', compact('project', 'tasklist'));
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
        return view('tasklists.edit', compact('project', 'tasklist'));
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

        return Redirect::route('projects.tasklists.show', [$project->slug, $tasklist->slug])->with('message', 'Tasklist updated.');
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

        return Redirect::route('projects.show', $project->slug)->with('message', 'Tasklist deleted.');
    }

}
