@extends('app')

@section('content')
    <!-- must be tasklist -->
    <h2>Create Task for Task List "{{ $project->name }}"</h2>

    {!! Form::model(new App\Task, ['route' => ['projects.tasklists.tasks.store', $project->slug], 'class'=>'']) !!}
        @include('tasks/partials/_form', ['submit_text' => 'Create Task'])
    {!! Form::close() !!}
@endsection