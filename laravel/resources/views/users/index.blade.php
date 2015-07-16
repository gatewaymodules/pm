@extends('app')

@section('content')

    <h3>People</h3>

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">People</li>
    </ol>

    @if ($users->count())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Phone</th>

            </tr>
            </thead>

            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><img width="50" height="50" src="{{ $user->avatar }}"></td>
                    <td><a href="{{ route('usertasks.show', $user->id, $user->name()) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->name() }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>

                    <td width="1%">{!! link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) !!}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    @else
        There are no users
    @endif

@stop