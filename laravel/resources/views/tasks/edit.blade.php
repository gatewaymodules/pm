@extends('app')

@section('content')
    <h2>Edit Task "{{ $task->name }}"</h2>

    {!! Form::model($task, ['method' => 'PATCH', 'route' => ['projects.tasklists.tasks.update', $project->slug, $tasklist->slug, $task->slug]]) !!}
        @include('tasks/partials/_form', ['submit_text' => 'Edit Task'])
    {!! Form::close() !!}
@endsection