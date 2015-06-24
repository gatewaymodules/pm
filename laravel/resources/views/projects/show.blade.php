@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/projects/">Projects </a></li>
        </li>
        <li class="active">{{  $project->name }} </li>
    </ol>

    @if ( !$project->tasklists->count() )
        <h2>{{ $project->name }}<span> <small>Project </small> <a href="{{ route('projects.tasklists.create', $project->slug) }}" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span> New Task List</a></span></h2>
        This project has no task lists.
    @else
        <table class="table table-hover">
            <thead>
            <tr>
                <td colspan="3"><h2>{{ $project->name }} <small>Project</small> <a href="{{ route('projects.tasklists.create', $project->slug) }}" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span> New Task List</a>
                    </h2></td>
            </tr>
            </thead>
            <tbody>
            @foreach( $project->tasklists as $tasklist )
                <tr>
                    <td>
                        <a href="{{ route('projects.tasklists.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a>
                    </td>
                    <td width="1%">
                        {!! link_to_route('projects.tasklists.edit', 'Edit', array($project->slug, $tasklist->slug),
                        array('class' => 'btn btn-sm btn-info')) !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif

@endsection