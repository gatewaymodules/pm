@extends('app')

@section('content')

    <h3>All Projects</h3>

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
                <th>Members</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $projects as $project )
                <tr>
                    <td><a href="{{ route('project.show', $project->slug) }}">{{ $project->name }}</a></td>
                    <td>
                    @foreach( $project->tasklists as $tasklist )
                            <a href="{{ route('project.tasklist.show', [$project->slug, $tasklist->slug]) }}">
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

                    <td>
                        @foreach ($project->users as $user) {{ $user->name()  }}, @endforeach
                    </td>

                <tr>
            @endforeach
            </tbody>
        </table>
        {{--
        {!! $projects->render() !!}<br>
        --}}

    @endif
    <a href="{{ route('project.create') }}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span>New Project</a>
@endsection