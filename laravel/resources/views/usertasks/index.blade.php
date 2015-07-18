@extends('app')

@section('content')

    <h3>All tasks assigned to {{$user->name()}}
        @if ($user->id <> Auth::user()->id) and {{ Auth::user()->name()  }}
    @endif
    </h3>

    <ol class="breadcrumb">
        <li class="active">Tasks by Person</li>
    </ol>

    @if ( !$tasks->count() )
        There are no tasks for this person
        <br><br>
    @else
        <table class="table table-hover" id="table-clickable">
            <thead>
            <tr>
                <th>Task</th>
                <th>Due</th>
                <th>Assigned To</th>
                <th>Project / Task list</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $tasks as $task )
                <tr>
                    <td>

                        <a href="{{ route('project.tasklist.task.show', [$task->tasklist->project->slug, $task->tasklist->slug, $task->slug]) }}">
                            @if ($task->priority) <font color="red"> @endif
                                {{ $task->name }}
                                @if ($task->priority) </font> @endif
                        </a>

                    </td>
                    <td>
                        {{$task->due_at()}}</td>
                    </td>
                    <td>
                        @foreach( $task->users as $user )
                            {{ $user->name() }},
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ 'project/' . $task->tasklist->project->slug }}">
                            {{ $task->tasklist->project->name }}
                        </a>/<a href="{{ 'project/' . $task->tasklist->project->slug . '/tasklist/' . $task->tasklist->slug }}">
                            {{ $task->tasklist->name }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
    <a href="{{ route('project.create') }}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span>New Project</a>
@endsection