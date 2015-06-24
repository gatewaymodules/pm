@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/projects/">Projects</a></li>
        <li><a href="{{ route('projects.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li class="active">{{  $tasklist->name }}</li>
    </ol>

    <h2>Edit Tasklist "{{ $tasklist->name }}"</h2>

    {!! Form::model($tasklist, ['method' => 'PATCH', 'route' => ['projects.tasklists.update', $project->slug, $tasklist->slug]]) !!}
        @include('tasklists.partials._form', ['submit_text' => 'Edit Tasklist'])
    {!! Form::close() !!}
@endsection