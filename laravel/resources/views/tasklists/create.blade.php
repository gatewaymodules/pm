@extends('app')

@section('content')
    <h2>Create Tasklist for Project "{{ $project->name }}"</h2>

    {!! Form::model(new App\Tasklist, ['route' => ['projects.tasklists.store', $project->slug], 'class'=>'']) !!}
        @include('tasklists.partials._form', ['submit_text' => 'Create Task List'])
    {!! Form::close() !!}
@endsection