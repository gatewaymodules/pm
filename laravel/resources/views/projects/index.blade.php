@extends('app')

@section('content')
    <h2>Projects
    </h2>

    @if ( !$projects->count() )
        You have no projects
    @else
        <div class="container">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                <tr>
                    <th>Project
                        <a href="http://pm.snowball.co.za/projects/server/edit" class="btn
                            btn-primary"><span class="glyphicon glyphicon-plus"></span> New</a>
                    </th>
                    <th>Edit</th>
                    <th>Delete</th>
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
        </div>
    @endif

    <p>
        {!! link_to_route('projects.create', 'Create Project') !!}
    </p>
@endsection