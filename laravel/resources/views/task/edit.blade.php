@extends('app')

@section('content')

    <h3>Edit task '{{ $task->name }}'</h3>

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('project.tasklist.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a></li>
        <li class="active">Edit Task</li>
    </ol>

    {!! Form::model($task, ['method' => 'PATCH', 'route' => ['project.tasklist.task.update', $project->slug, $tasklist->slug, $task->slug]]) !!}
        @include('task/partials/_form', ['submit_text' => 'Save'])
    {!! Form::close() !!}
    
@endsection