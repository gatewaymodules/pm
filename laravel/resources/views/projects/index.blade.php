@extends('app')

@section('content')

    @if ( !$projects->count() )
        <h2>Projects
        </h2>
        There are no projects
    @else
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Projects</li>
        </ol>
        <table class="table table-hover" id="table-clickable">
            <thead>
            <tr>
                <th colspan="2"><h2>Project</h2></th>
            </tr>
            </thead>
            <tbody>
            @foreach( $projects as $project )
                <tr>
                    <td><a href="{{ route('projects.show', $project->slug) }}">{{ $project->name }}</a></td>
                <tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span> New Project</a>
    @endif

@endsection