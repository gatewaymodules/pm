@extends('app')

@section('content')
    <h2>Projects</h2>

    <ol class="breadcrumb">
        <li class="active">Projects</li>
    </ol>

    @if ( !$projects->count() )
        There are no projects
        <br><br>
    @else
        <table class="table table-hover" id="table-clickable">
            <thead>
            <tr>
                <th>Project</th>
                <th>Lists</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $projects as $project )
                <tr>
                    <td><a href="{{ route('projects.show', $project->slug) }}">{{ $project->name }}</a></td>
                    <td>
                    @foreach( $project->tasklists as $tasklist )
                            <a href="{{ route('projects.tasklists.show', [$project->slug, $tasklist->slug]) }}">
                                @if ( $tasklist->hasPriorityTasks())
                                    <font color="red">
                                        @endif
                                        {{ $tasklist->name }},
                                        @if ( $tasklist->hasPriorityTasks() )
                                    </font>
                                @endif
                            </a>
                    @endforeach
                    </td>
                <tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span> New Project</a>
    @endif

@endsection