@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/projects/">Projects </a></li>
        </li>
        <li class="active">{{  $project->name }} </li>
    </ol>

    @if ( !$project->tasklists->count() )
        <h2>{{ $project->name }} <small>Project</small></h2>
        This project has no task lists.
        <br><br>
    @else
        <table class="table table-hover" id="table-clickable">
            <thead>
            <tr>
                <td colspan="2"><h2>{{ $project->name }} <small>Project</small> {!! link_to_route('projects.edit', 'Edit', array($project->slug), array('class' =>
                        'btn btn-sm btn-info')) !!}
                    </h2></td>
            </tr>
            </thead>
            <tbody>
            @foreach( $project->tasklists as $tasklist )
                <tr>
                    <td>
                        <a href="{{ route('projects.tasklists.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

    @endif
    <a href="{{ route('projects.tasklists.create', $project->slug) }}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span> New Task List</a>
@endsection