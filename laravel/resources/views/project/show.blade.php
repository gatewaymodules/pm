@extends('app')

@section('content')

    <h3>{{ $project->name }} <small>Project</small> {!! link_to_route('project.edit', 'Edit', array($project->slug), array('class' =>'btn btn-sm btn-info')) !!}
    </h3>

    <ol class="breadcrumb">
        <li><a href="/project/">Projects </a></li>
        </li>
        <li class="active">{{  $project->name }} </li>
    </ol>

    @if ( !$project->tasklists->count() )
        This project has no task lists.
        <br><br>
    @else
        <table class="table table-hover" id="table-clickable">
            <thead>
            <tr>
                <th>List</th>
                <th>Tasks</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $project->tasklists as $tasklist )
                <tr>
                    <td>
                        <a href="{{ route('project.tasklist.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a>
                    </td>
                    <td>
                        @foreach( $tasklist->tasks as $task )
                            @if ( $task->completed )
                                <del>
                                    @endif
                                    <a href="{{ route('project.tasklist.task.show', [$project->slug, $tasklist->slug, $task->slug]) }}">
                                        @if ( $task->priority )
                                            <font color="red">
                                                @endif
                                                {{ $task->name }},
                                                @if ( $task->priority )
                                            </font>
                                        @endif
                                    </a>
                                    @if ( $task->completed )
                                </del>
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

    @endif
    <a href="{{ route('project.tasklist.create', $project->slug) }}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span> New Task List</a>
@endsection