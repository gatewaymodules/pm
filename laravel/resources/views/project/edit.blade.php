@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/project/">Projects</a></li></li>
        <li class="active">Edit {{  $project->name }} </li>
    </ol>

    <h2>Edit Project</h2>

    {!! Form::model($project, ['method' => 'PATCH', 'route' => ['project.update', $project->slug]]) !!}
        @include('project/partials/_form', ['submit_text' => 'Edit Project'])
    {!! Form::close() !!}

@endsection