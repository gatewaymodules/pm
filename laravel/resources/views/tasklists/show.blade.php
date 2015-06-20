@extends('app')

@section('content')
    <h2>
        {!! link_to_route('projects.show', $project->name, [$project->slug]) !!} -
        {{ $tasklist->name }}
    </h2>

    {{ $tasklist->description }}
@endsection