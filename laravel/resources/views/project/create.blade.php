@extends('app')

@section('content')

    <h3>Create new project
    </h3>

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/project/">Projects</a></li></li>
        <li class="active">New Project</li>
    </ol>

    {!! Form::model(new App\Project, ['route' => ['project.store']]) !!}
        @include('project/partials/_form', ['submit_text' => 'Create Project'])
    {!! Form::close() !!}

@endsection

