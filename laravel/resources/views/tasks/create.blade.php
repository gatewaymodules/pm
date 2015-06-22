@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/projects/">Projects</a></li>
        <li><a href="{{ route('projects.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('projects.tasklists.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a></li>
        <li class="active">New Task</li>
    </ol>
    <h2>Create Task in project {{ $project->name }} for Task List "{{ $tasklist->name }}"</h2>

    {!! Form::model(new App\Task, ['route' => ['projects.tasklists.tasks.store', $project->slug, $tasklist->slug], 'class'=>'']) !!}
        @include('tasks/partials/_form', ['submit_text' => 'Create Task'])
    {!! Form::close() !!}
@endsection