@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/projects/">Projects</a></li>
        <li><a href="{{ route('projects.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('projects.tasklists.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a></li>
        <li class="active">{{  $task->name }}</li>
    </ol>

    {{ $task->description }}
@endsection