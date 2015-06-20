@extends('app')

@section('content')


    @if ( !$project->tasks->count() )
        <h2>{{ $project->name }}</h2>
        This project has no tasks.
    @else

        <table class="table table-hover">
            <thead>
            <tr>
                <td colspan="3"><h2>{{ $project->name }} <a href="{{ route('projects.tasks.create', $project->slug) }}" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span> New Task</a>
                    </h2></td>
            </tr>
            </thead>
            <tbody>
            @foreach( $project->tasks as $task )
                <tr>
                    <td>
                        <a href="{{ route('projects.tasks.show', [$project->slug, $task->slug]) }}">{{ $task->name }}</a>
                    </td>
                    <td>
                        {!! link_to_route('projects.tasks.edit', 'Edit', array($project->slug, $task->slug), array('class' => 'btn btn-info')) !!}
                    </td>
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.tasks.destroy', $project->slug, $task->slug))) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

    @endif

    <p>
        {!! link_to_route('projects.index', 'Back to Projects') !!} |
    </p>
@endsection