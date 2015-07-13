@extends('app')

@section('content')

    <h3>All tasks assigned to {{$user->name()}}</h3>

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
                <th>Project</th>
                <th>Task list</th>
                <th>Due</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $tasks as $task )
                <tr>
                    <td>
                        <a href="{{ $task->url }}">
                            @if ($task->priority) <font color='red'>@endif
                                {{$task->name}}
                                @if ($task->priority) </font> @endif
                        </a>
                    </td>
                    <td>
                        {{ $task->tasklist->name }}
                    </td>
                    <td>
                        {{ $task->tasklist->project->name }}
                    </td>
                    <td>
                        {{$task->due_at}}</td>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
    <a href="{{ route('project.create') }}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span>New Project</a>
@endsection