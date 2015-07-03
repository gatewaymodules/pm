@extends('app')

@section('content')

    <h3>{{ $tasklist->name }}
        <small>List</small>
        {!! link_to_route('project.tasklist.edit', 'Edit', array($project->slug, $tasklist->slug),
        array('class' => 'btn btn-sm btn-info')) !!}
    </h3>

    <ol class="breadcrumb">
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li class="active">{{  $tasklist->name }}</li>
    </ol>

    @if ( !$tasklist->tasks->count() )
        This list has no tasks.
        <br><br>
    @else
        <table class="table table-hover" id="table-clickable">
            <thead>
            <tr>
                <th>Task
                </th>
                <th>Assigned to</th>
                <th>Due</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $tasklist->tasks as $task )
                <tr>
                    <td>
                        @if ( $task->completed )
                            <del>
                                @endif
                                <a href="{{ route('project.tasklist.task.show', [$project->slug, $tasklist->slug, $task->slug]) }}">
                                    @if ( $task->priority )
                                        <font color="red">
                                            @endif
                                            {{ $task->name }}
                                            @if ( $task->priority )
                                        </font>

                                    @endif
                                </a>
                                @if ( $task->completed )
                            </del>
                        @endif
                    </td>
                    <td>
                        @foreach( $task->users as $user )
                            {{ $user->name }},
                        @endforeach
                    </td>
                    <td>
                        {{ $task->due_at() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ route('project.tasklist.task.create', [$project->slug, $tasklist->slug]) }}"
       class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span> New Task</a>
@endsection