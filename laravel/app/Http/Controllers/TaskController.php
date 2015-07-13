<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Project;
use App\Tasklist;
use App\Task;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class TaskController extends Controller {

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
     * Task is sent for getRelatedIds but will always be an empty array as on creation there are no selected items
     *
     * @param Project $project
     * @param Tasklist $tasklist
     * @param Task $task
     * @return Response
     * @internal param Tasklist $task
     * @internal param Tasklist $tasklist
     * @internal param \App\Project $project
     */
    public function create(Project $project, Tasklist $tasklist, Task $task)
	{
        $users = User::orderBy('name')->lists('name', 'id');
        $old_task_status = 0;
        $due_at_default = null;
        return view('task.create', compact('project', 'tasklist', 'users', 'task', 'due_at_default','old_task_status'));
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

        $url = route('project.tasklist.task.show', [$project->slug, $tasklist->slug, $input['slug']]);
        $input['url'] = $url;
        $user_id = \Auth::user()->id;
        $input['user_id'] = $user_id;
		$task = Task::create( $input );

        // Sync many to many table
        $assigned_to = Input::get('assigned_to');
        // Only sync if assigned_to multi select had some data
        if ($assigned_to) {
            $task->users()->sync($assigned_to);
        }

        // TODO Redo logging framework
        // Log this event
        $name = $input['name'];

        $name = "<a href='" . route('project.tasklist.show', [$project->slug, $tasklist->slug]) . "'>" . $name . "</a>";
        $due_at_text = $input['due_at'];
        if ($due_at_text <> '') {
            $due_at_text = " due at " . $due_at_text;
        } else {
            $due_at_text = "";
        }
        $event = "New task {$name} $due_at_text was created.";

        \DB::table('logs')->insert(["description"=>"$event", 'user_id'=>$user_id]);

		return Redirect::route('project.tasklist.show', [$project->slug, $tasklist->slug])->with('Task created.');
	}

    /**
     * @param Project $project
     * @param Tasklist $tasklist
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function show(Project $project, Tasklist $tasklist, Task $task)
	{
        $id = $task->id;
        return view('task.show', compact('project', 'tasklist', 'task', 'id'));
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
        $users = User::orderBy('name')->lists('name', 'id');
        $selected_users = $task->users()->getRelatedIds()->toArray();
        $old_task_status = $task->completed;
        if ($task->due_at == '0000-00-00 00:00:00') {
            $due_at_default = '';
        } else {
            $due_at_default = null;
        }
        return view('task.edit', compact('project', 'tasklist', 'task', 'users', 'selected_users', 'due_at_default', 'old_task_status'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Project $project
     * @param Tasklist $tasklist
     * @param  \App\Task $task
     * @param \Illuminate\Http\Request $requestif ($task->due_at())
     * @return Response
     * @internal param \App\Project $project
     */
	public function update(Project $project, Tasklist $tasklist, Task $task, Request $request)
	{
		$this->validate($request, $this->rules);

		$input = array_except(Input::all(), '_method');

        // Update the URL
        $url = route('project.tasklist.task.show', [$project->slug, $tasklist->slug, $input['slug']]);
        $input['url'] = $url;

        // Get task completion status and update database if value changed
        if ($input['old_task_status'] == 0 && $input['completed'] == 1) {
            $input['completed_at'] = \Carbon\Carbon::now();
        }

		$task->update($input);

        // Sync many to many
        $assigned_to = Input::get('assigned_to');
        // Only sync if assigned_to multi select had some data
        if ($assigned_to) {
            $task->users()->sync($assigned_to);
        }

        return Redirect::route('project.tasklist.task.show', [$project->slug, $tasklist->slug, $task->slug])->with('message', 'Task updated.');
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
	public function destroy(Project $project, Tasklist $tasklist, Task $task)
	{
		$task->delete();

		return Redirect::route('project.tasklist.show', [$project->slug, $tasklist->slug])->with('message', 'Task deleted.');
	}

    // User defined methods

}
