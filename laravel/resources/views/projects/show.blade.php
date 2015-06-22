@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/projects/">Projects</a></li>
        </li>
        <li class="active">{{  $project->name }} </li>
    </ol>

    @if ( !$project->tasklists->count() )
        <h2>{{ $project->name }}<span>
        <a href="{{ route('projects.tasklists.create', $project->slug) }}" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span> New Task List</a></span></h2>
        This project has no task lists.

    @else

        <table class="table table-hover">
            <thead>
            <tr>
                <td colspan="3"><h2>{{ $project->name }}
                        <a href="{{ route('projects.tasklists.create', $project->slug) }}" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span> New Task List</a>
                    </h2></td>
            </tr>
            </thead>
            <tbody>
            @foreach( $project->tasklists as $tasklist )
                <tr>
                    <td width="98%">
                        <a href="{{ route('projects.tasklists.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a>
                    </td>
                    <td>
                        {!! link_to_route('projects.tasklists.edit', 'Edit', array($project->slug, $tasklist->slug),
                        array('class' => 'btn btn-info')) !!}
                    </td>
                    <td>
                        {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' =>
                        array('projects.tasklists.destroy', $project->slug, $tasklist->slug))) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

    @endif

@endsection