@extends('app')

@section('content')

    <h3>{{ $tasklist->name }}
        <small>Calendar</small>
        <a href="{{ route('project.tasklist.show', [$project->slug, $tasklist->slug]) }}" style="float:right" class="btn btn-sm btn-success">Task List</a>

    </h3>

    {!! $calendar->calendar() !!}

@endsection

@section('javascript')

    {!! $calendar->script() !!}

@endsection

@stop