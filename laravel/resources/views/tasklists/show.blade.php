@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/projects/">Projects</a></li>
        <li><a href="{{ route('projects.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li class="active">{{  $tasklist->name }}</li>
    </ol>

    @if ( !$tasklist->tasks->count() )
        <h2>{{ $tasklist->name }} <small>List</small>
            {!! link_to_route('projects.tasklists.edit', 'Edit', array($project->slug, $tasklist->slug),
            array('class' => 'btn btn-sm btn-info')) !!}
        </h2>
        This list has no tasks.<br><br>
    @else
        <table class="table table-hover" id="table-clickable">
            <thead>
            <tr>
                <th colspan="2"><h2>{{ $tasklist->name }} <small>List </small>
                        {!! link_to_route('projects.tasklists.edit', 'Edit', array($project->slug, $tasklist->slug),
                        array('class' => 'btn btn-sm btn-info')) !!}
                    </h2></th>
            </tr>
            </thead>
            <tbody>
            @foreach( $tasklist->tasks as $task )
                <tr>
                    <td>
                        <a href="{{ route('projects.tasklists.tasks.show', [$project->slug, $tasklist->slug , $task->slug]) }}">
                            @if ( $task->completed )
                                <del>
                                    {{ $task->name }}
                                </del>
                            @else
                                {{ $task->name }}
                            @endif
                        </a>
                    </td>
                    <td>
                        {{ $task->due_at() }}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ route('projects.tasklists.tasks.create', [$project->slug, $tasklist->slug]) }}"
       class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span> New Task</a>
@endsection