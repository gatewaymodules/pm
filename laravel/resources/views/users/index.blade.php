@extends('app')

@section('content')

    <h1>Users</h1>

    <p>{!! link_to_route('users.create', 'Register new user') !!}</p>
    <p><a href="{{ url('auth/logout') }}">Register</a></p>

    @if ($users->count())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>

                    <td>{!! link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) !!}</td>
                    <td>
                        {!! Form::open(array('method'=> 'DELETE', 'route' => array('users.destroy', $user->id))) !!}
                        {!! Form::submit('Delete', array('class'=> 'btn btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
    @else
        There are no users
    @endif

@stop