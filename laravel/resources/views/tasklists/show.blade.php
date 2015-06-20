@extends('app')

@section('content')


    @if ( !$tasklist->tasks->count() )
        <h2>{{ $tasklist->name }}</h2>
        This list has no tasks.
    @else

        <table class="table table-hover">
            <thead>
            <tr>
                <td colspan="3"><h2>{{ $tasklist->name }} <a href="{{ route('projects.tasklists.create', $tasklist->slug) }}" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span> New List</a>
                    </h2></td>
            </tr>
            </thead>
            <tbody>
            @foreach( $tasklist->tasks as $task )
                <tr>
                    <td>
                        <a href="{{ route('projects.tasklists.tasks.show', [$project->slug, $tasklist->slug , $task->slug]) }}">{{ $task->name }}</a>
                    </td>
                    <td>
                        {!! link_to_route('projects.tasklists.tasks.edit', 'Edit', array($project->slug, $tasklist->slug, $task->slug), array('class' => 'btn btn-info')) !!}
                    </td>
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.tasklists.destroy', $project->slug, $task->slug))) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

    @endif

    <p>
        <a href="{{ route('projects.tasklists.tasks.create', $project->slug . $tasklist->slug) }}" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span> New Task</a> |
        {!! link_to_route('projects.index', 'Back to Projects') !!}
    </p>
@endsection