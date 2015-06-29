<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Input;
use Redirect;
use Response;
use App\User;
use App\Task;
use App\Tasklist;
use App\Project;

class SearchController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function queryTasks()
    {
        $query = Input::get('user');
        $res   = Task::where('name', 'LIKE', "%$query%")->get();
        return Response::json($res);
    }

    public function queryTasklists()
    {
        $query = Input::get('user');
        $res   = Tasklist::where('name', 'LIKE', "%$query%")->get();
        return Response::json($res);
    }

    public function queryProjects()
    {
        $query = Input::get('user');
        $res   = Project::where('name', 'LIKE', "%$query%")->get();
        return Response::json($res);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //return View::make('search.index');
        return view('search.index');
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
