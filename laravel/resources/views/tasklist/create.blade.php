@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li class="active">New Task List</li>
    </ol>
    <h2>Create task list for "{{ $project->name }}"</h2>

    {!! Form::model(new App\Tasklist, ['route' => ['project.tasklist.store', $project->slug], 'class'=>'']) !!}
        @include('tasklist.partials._form', ['submit_text' => 'Create Task List'])
    {!! Form::close() !!}
@endsection