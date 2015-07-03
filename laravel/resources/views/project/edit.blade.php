@extends('app')

@section('content')

    <h3>Edit project '{{ $project->name }}'</h3>

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/project/">Projects</a></li></li>
        <li class="active">Edit Project</li>
    </ol>

    {!! Form::model($project, ['method' => 'PATCH', 'route' => ['project.update', $project->slug]]) !!}
        @include('project/partials/_form', ['submit_text' => 'Edit Project'])
    {!! Form::close() !!}

@endsection