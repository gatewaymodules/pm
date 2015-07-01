@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li class="active">{{  $tasklist->name }}</li>
    </ol>

    <h2>Edit Tasklist "{{ $tasklist->name }}"</h2>

    {!! Form::model($tasklist, ['method' => 'PATCH', 'route' => ['project.tasklist.update', $project->slug, $tasklist->slug]]) !!}
        @include('tasklist.partials._form', ['submit_text' => 'Edit Tasklist'])
    {!! Form::close() !!}
@endsection