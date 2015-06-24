@extends('app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">Users</li>
    </ol>

    <h2>Users</h2>

    @if ($users->count())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Admin</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->hasRole('admin')}}</td>
                    <td width="1%">{!! link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) !!}</td>
                    <td width="1%">
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