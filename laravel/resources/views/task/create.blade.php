@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('project.tasklist.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a></li>
        <li class="active">New Task</li>
    </ol>
    <h2>Create Task in project {{ $project->name }} for Task List "{{ $tasklist->name }}"</h2>

    {!! Form::model(new App\Task, ['route' => ['project.tasklist.task.store', $project->slug, $tasklist->slug], 'class'=>'']) !!}
        @include('task/partials/_form', ['submit_text' => 'Create Task'])
    {!! Form::close() !!}
@endsection