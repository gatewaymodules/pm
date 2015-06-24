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
        <table class="table table-hover">
            <thead>
            <tr>
                <th colspan="3"><h2>Projects <a href="{{ route('projects.create') }}" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span> New Project</a>
                    </h2></th>
            </tr>
            </thead>
            <tbody>
            @foreach( $projects as $project )
                <tr>
                    <td><a href="{{ route('projects.show', $project->slug) }}">{{ $project->name }}</a></td>
                    <td width="1%">{!! link_to_route('projects.edit', 'Edit', array($project->slug), array('class' =>
                        'btn btn-sm btn-info')) !!}
                    </td>
                <tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection