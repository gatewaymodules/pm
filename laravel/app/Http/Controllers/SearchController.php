<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Input;
use Redirect;
use Response;

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
        $res = DB::select("select 'task' AS `type`, tasks.* from tasks where name like ?", ['%'.$query.'%']);
        return response()->json($res);
    }

    public function queryTasklists()
    {
        $query = Input::get('user');
        $res = DB::select("select 'tasklist' AS `type`, tasklists.* from tasklists where name like ?", ['%'.$query.'%']);
        return response()->json($res);
    }

    public function queryProjects()
    {
        $query = Input::get('user');
        $res = DB::select("select 'project' AS `type`, projects.* from projects where name like ?", ['%'.$query.'%']);
        return response()->json($res);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
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
