@extends('app')

@section('content')

    <h3>Edit user '{{ $user->name }}'</h3>

    <ol class="breadcrumb">
        <li><a href="/users/">Users</a></li>
        <li class="active">Edit Users</li>
    </ol>

    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id ]]) !!}
    @include('users/partials/_form', ['submit_text' => 'Edit User'])
    {!! Form::close() !!}

@endsection
