@extends('app')

@section('content')
    <h2>Edit Tasklist "{{ $tasklist->name }}"</h2>

    {!! Form::model($tasklist, ['method' => 'PATCH', 'route' => ['projects.tasklists.update', $project->slug, $tasklist->slug]]) !!}
        @include('tasklists.partials._form', ['submit_text' => 'Edit Tasklist'])
    {!! Form::close() !!}
@endsection