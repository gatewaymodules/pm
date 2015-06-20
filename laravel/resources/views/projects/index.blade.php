@extends('app')

@section('content')


    @if ( !$projects->count() )
        <h2>Projects
        </h2>
        You have no projects
    @else

            <table class="table table-hover">
                <thead>
                <tr>
                    <th colspan="3"><h2>Projects <a href="{{ route('projects.create') }}" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> New </a>
                        </h2></th>
                </tr>
                </thead>
                <tbody>
                @foreach( $projects as $project )
                    <tr>
                        <td width="98%"><a href="{{ route('projects.show', $project->slug) }}">{{ $project->name }}</a></td>
                        <td width="1%">{!! link_to_route('projects.edit', 'Edit', array($project->slug), array('class' => 'btn
                            btn-info')) !!}
                        </td>
                        <td width="1%">
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