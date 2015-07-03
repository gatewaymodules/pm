@extends('app')

@section('content')
    <h3>Creating new task list for project '{{ $project->name }}'</h3>

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li class="active">New Task List</li>
    </ol>

    {!! Form::model(new App\Tasklist, ['route' => ['project.tasklist.store', $project->slug], 'class'=>'']) !!}
        @include('tasklist.partials._form', ['submit_text' => 'Create Task List'])
    {!! Form::close() !!}
@endsection