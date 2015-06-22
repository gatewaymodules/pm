@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="{{ route('projects.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li class="active">New Task List</li>
    </ol>
    <h2>Create task list for "{{ $project->name }}"</h2>

    {!! Form::model(new App\Tasklist, ['route' => ['projects.tasklists.store', $project->slug], 'class'=>'']) !!}
        @include('tasklists.partials._form', ['submit_text' => 'Create Task List'])
    {!! Form::close() !!}
@endsection