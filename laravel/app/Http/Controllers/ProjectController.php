<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use DB;
use Input;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class ProjectController extends Controller {

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
	 * @return Response
	 */
	public function index()
	{
        $user_id = Auth::user()->id;
        $projects = User::find($user_id)->projects;
		return view('project.index', compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('project.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, $this->rules);
        $input = Input::all();
		Project::create( $input );

        $project_id = DB::getPdo()->lastInsertId();

        $user = Auth::user();
        $user->projects()->attach($project_id);

		return Redirect::route('project.index')->with('message', 'Project created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Project $project
	 * @return Response
	 */
    public function show(Project $project)
	{
		return view('project.show', compact('project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Project $project
	 * @return Response
	 */
	public function edit(Project $project)
	{
		return view('project.edit', compact('project'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Project $project
	 * @param \Illuminate\Http\Request $request
	 * @return Response
	 */
	public function update(Project $project, Request $request)
	{
		$this->validate($request, $this->rules);

		$input = array_except(Input::all(), '_method');
		$project->update($input);

		return Redirect::route('project.show', $project->slug)->with('message', 'Project updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Project $project
	 * @return Response
	 */
	public function destroy(Project $project)
	{
		$project->delete();

		return Redirect::route('project.index')->with('message', 'Project deleted.');
	}

}
