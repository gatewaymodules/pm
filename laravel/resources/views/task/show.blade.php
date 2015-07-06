@extends('app')

@section('content')

    <h3>{{ $task->name }} <small>Task</small> {!! link_to_route('project.tasklist.task.edit', 'Edit', array($project->slug,
        $tasklist->slug, $task->slug), array('class' => 'btn btn-sm btn-info')) !!}
    </h3>

    <ol class="breadcrumb">
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('project.tasklist.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a></li>
        <li class="active">{{  $task->name }}</li>
    </ol>

    {!! nl2br(e($task->description)) !!}
@endsection