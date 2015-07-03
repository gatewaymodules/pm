@extends('app')

@section('content')

    <h3>Edit task list '{{ $tasklist->name }}'</h3>

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li class="active">Edit Task List</li>
    </ol>

    {!! Form::model($tasklist, ['method' => 'PATCH', 'route' => ['project.tasklist.update', $project->slug, $tasklist->slug]]) !!}
        @include('tasklist.partials._form', ['submit_text' => 'Edit Tasklist'])
    {!! Form::close() !!}
@endsection