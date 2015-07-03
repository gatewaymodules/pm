@extends('app')

@section('content')
    <h3>Create task in list '{{ $tasklist->name }}' for project '{{ $project->name }}'.</h3>
    <ol class="breadcrumb">
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('project.tasklist.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a></li>
        <li class="active">New Task</li>
    </ol>

    {!! Form::model(new App\Task, ['route' => ['project.tasklist.task.store', $project->slug, $tasklist->slug], 'class'=>'']) !!}
        @include('task/partials/_form', ['submit_text' => 'Create Task'])
    {!! Form::close() !!}
@endsection