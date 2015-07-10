<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Project;
use App\Task;
use App\Tasklist;
use Illuminate\Support\Facades\Redirect;
use Input;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
     * @param Project $project
     * @param Tasklist $tasklist
     * @param Task $task
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function store(Project $project, Tasklist $tasklist, Task $task)
    {
        //dd($id);
        $new_comment = Input::get('comment');
        //$new_comment = Input::get('comment');
        //$task_id = $id;
        $task_id = Input::get('task_id');
        $user_id = Input::get('user_id');
        echo "Storing comment " . $new_comment;
        $comment = new Comment();
        $comment->comment = $new_comment;
        $comment->task_id = $task_id;
        $comment->user_id = $user_id;
        $comment->save();
        return Redirect::route('project.tasklist.task.show', [$project->slug, $tasklist->slug, $task->slug])->with('Comment added.');

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
     * @param Project $project
     * @param Tasklist $tasklist
     * @param Task|\App\Task $task
     * @param \Illuminate\Http\Request $request
     * @return Response
     * @internal param \App\Project $project
     */
    public function update(Project $project, Tasklist $tasklist, Task $task, Request $request)
    {
        //return Redirect::route('project.tasklist.show', [$project->slug, $tasklist->slug])->with('message', 'Task updated.');
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
