<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Project;
use App\Tasklist;
use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller {

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
     * @param Tasklist $tasklist
     * @return Response
     * @internal param \App\Project $project
     */
	public function index(Tasklist $tasklist)
	{
		return view('tasks.index', compact('tasklist'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param Project $project
     * @param Tasklist $tasklist
     * @return Response
     * @internal param Tasklist $task
     * @internal param Tasklist $tasklist
     * @internal param \App\Project $project
     */
	//public function create(Tasklist $tasklist)
    public function create(Project $project, Tasklist $tasklist)
	{
        return view('tasks.create', compact('project', 'tasklist'));
		//return view('tasks.create', compact('tasklist'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Project $project
     * @param Tasklist $tasklist
     * @param \Illuminate\Http\Request $request
     * @return Response
     * @internal param \App\Project $project
     */
	public function store(Project $project, Tasklist $tasklist, Request $request)
	{
		$this->validate($request, $this->rules);

		$input = Input::all();
		$input['tasklist_id'] = $tasklist->id;
		Task::create( $input );

		return Redirect::route('projects.tasklists.show', [$project->slug, $tasklist->slug])->with('Task created.');
	}

    /**
     * @param Project $project
     * @param Tasklist $tasklist
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function show(Project $project, Tasklist $tasklist, Task $task)
	{
        return view('tasks.show', compact('project', 'tasklist', 'task'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @param Tasklist $tasklist
     * @param  \App\Task $task
     * @return Response
     * @internal param \App\Project $project
     */
    public function edit(Project $project, Tasklist $tasklist, Task $task)
	{
        return view('tasks.edit', compact('project', 'tasklist', 'task'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Project $project
     * @param Tasklist $tasklist
     * @param  \App\Task $task
     * @param \Illuminate\Http\Request $request
     * @return Response
     * @internal param \App\Project $project
     */
	public function update(Project $project, Tasklist $tasklist, Task $task, Request $request)
	{
		$this->validate($request, $this->rules);

		$input = array_except(Input::all(), '_method');
		$task->update($input);

		return Redirect::route('projects.tasklists.tasks.show', [$project->slug, $tasklist->slug, $task->slug])->with('message', 'Task updated.');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Tasklist $tasklist
     * @param  \App\Task $task
     * @return Response
     * @throws \Exception
     * @internal param \App\Project $project
     */
	public function destroy(Tasklist $tasklist, Task $task)
	{
		$task->delete();

		return Redirect::route('tasklists.show', $tasklist->slug)->with('message', 'Task deleted.');
	}

}
