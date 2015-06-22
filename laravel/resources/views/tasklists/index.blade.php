@extends('app')

@section('content')

    @if ( !$tasklists->count() )
        <h2>Task lists
        </h2>
        This project has task lists
    @else
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/">Projects</a></li>
            <li>{{  $project->name }} </li>
            <li>{{  isset($tasklist->name) ? link_to_route('projects.show', $tasklist->name, [$tasklist->slug])  : '' }}</li>
            <li class="active">{{  isset($task->name) ? $task->name  : '' }}</li>
        </ol>
            <table class="table table-hover">
                <thead>
                <tr>
                    <td colspan="3"><h2>Projects <a href="{{ route('projects.create') }}" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> New </a>
                        </h2></td>
                </tr>
                </thead>
                <tbody>
                @foreach( $projects as $project )
                    <tr>
                        <td><a href="{{ route('projects.show', $project->slug) }}">{{ $project->name }}</a></td>
                        <td>{!! link_to_route('projects.edit', 'Edit', array($project->slug), array('class' => 'btn
                            btn-info')) !!}
                        </td>
                        <td>
                            {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' =>
                            array('projects.destroy', $project->slug))) !!}
                            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                            {!! Form::close() !!}

                        </td>
                    <tr>
                @endforeach
                </tbody>
            </table>

    @endif

@endsection