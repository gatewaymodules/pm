@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/projects/">Projects</a></li>
        <li><a href="{{ route('projects.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li class="active">{{  $tasklist->name }}</li>
    </ol>

    @if ( !$tasklist->tasks->count() )
        <h2>{{ $tasklist->name }}
            <span>
            <a href="{{ route('projects.tasklists.tasks.create', [$project->slug, $tasklist->slug]) }}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span> New Task</a>
        </span>
        </h2>
        This list has no tasks.
        <p>

        </p>
    @else

        <table class="table table-hover">
            <thead>
            <tr>
                <td colspan="3"><h2>{{ $tasklist->name }} <a href="{{ route('projects.tasklists.tasks.create', [$project->slug, $tasklist->slug]) }}" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span> New Task</a>
                    </h2></td>
            </tr>
            </thead>
            <tbody>
            @foreach( $tasklist->tasks as $task )
                <tr>
                    <td width="98%">
                        <a href="{{ route('projects.tasklists.tasks.show', [$project->slug, $tasklist->slug , $task->slug]) }}">{{ $task->name }}</a>
                    </td>
                    <td width="1%">
                        {!! link_to_route('projects.tasklists.tasks.edit', 'Edit', array($project->slug, $tasklist->slug, $task->slug), array('class' => 'btn btn-info')) !!}
                    </td>
                    <td width="1%">
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.tasklists.destroy', $project->slug, $task->slug))) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

    @endif

@endsection