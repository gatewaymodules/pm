@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/projects/">Projects</a></li>
        <li><a href="{{ route('projects.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('projects.tasklists.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a></li>
        <li class="active">{{  $task->name }}</li>
    </ol>
    <h2>{{ $task->name }} <small>Task</small> {!! link_to_route('projects.tasklists.tasks.edit', 'Edit', array($project->slug,
        $tasklist->slug, $task->slug), array('class' => 'btn btn-sm btn-info')) !!}
    </h2>
    {!! nl2br(e($task->description)) !!}
@endsection