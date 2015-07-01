@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/projects/">Projects</a></li></li>
        <li class="active">New Project</li>
    </ol>

    <h2>Create Project
    </h2>

    {!! Form::model(new App\Project, ['route' => ['project.store']]) !!}
        @include('project/partials/_form', ['submit_text' => 'Create Project'])
    {!! Form::close() !!}

@endsection

