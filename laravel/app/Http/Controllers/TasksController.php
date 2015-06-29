<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Project;
use App\Tasklist;
use App\Task;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

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
    public function create(Project $project, Tasklist $tasklist)
	{
        $users = User::lists('name', 'id');
        return view('tasks.create', compact('project', 'tasklist', 'users'));
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

		$task = Task::create( $input );
        //Task::create( $input );

        $assigned_to = Input::get('assigned_to');
        $task->users()->sync($assigned_to);

        return Redirect::route('projects.tasklists.show', [$project->slug, $tasklist->slug])->with('Task created.');

        echo "<pre>";
        print_r($task, 1);
        echo "xxx----<br>";



        //die($task);
//
//        // Save the result ID for later use
        $task_id = $task['id'];

        print_r($task_id);
        echo "yyy----<br>";

        $assigned_to = $input['assigned_to'];

        print_r($input['assigned_to']);

        $task->user()->attach($assigned_to);

//
//        die($task);
//
//        // Store assigned_to
        foreach (Input::get('assigned_to') as $user) {
            $selected[] = New User(['user' => $user]);
        }
        //die(print_r($selected,1));
//        Task::find($task_id)->users->saveMany($selected);

        // Log this event
        $name = $input['name'];
        $name = "<a href='" . route('projects.tasklists.show', [$project->slug, $tasklist->slug]) . "'>" . $name . "</a>";
        $due_at_text = $input['due_at'];
        if ($due_at_text <> '') {
            $due_at_text = " due at " . $due_at_text;
        } else {
            $due_at_text = "";
        }
        $event = "New task {$name} $due_at_text was created.";
        $user_id = \Auth::user()->id;
        \DB::table('logs')->insert(["description"=>"$event", 'user_id'=>$user_id]);

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
        $users = User::lists('name', 'id');
        $selected_users = $task->users()->getRelatedIds()->toArray();
        return view('tasks.edit', compact('project', 'tasklist', 'task', 'users', 'selected_users'));
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

        $assigned_to = Input::get('assigned_to');
        $task->users()->sync($assigned_to);

        return Redirect::route('projects.tasklists.show', [$project->slug, $tasklist->slug])->with('message', 'Task updated.');
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

		return Redirect::route('projects.tasklists.show', [$project->slug, $tasklist->slug])->with('message', 'Task deleted.');
	}

}
