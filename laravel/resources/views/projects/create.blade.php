@extends('app')

@section('content')
    <h2>Create Project
    </h2>

    {!! Form::model(new App\Project, ['route' => ['projects.store']]) !!}
        @include('projects/partials/_form', ['submit_text' => 'Create Project'])
    {!! Form::close() !!}

    <p>
        {!! link_to_route('projects.index', 'Back to Projects') !!}
    </p>
@endsection

