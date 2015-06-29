@extends('app')

@section('content')

{!! Form::open(['url' => '/profile', 'method' => 'get']) !!}
{!! Form::text('user', null, ['id'=>'users']) !!}
{!! Form::submit('GO') !!}
{!! Form::close() !!}

@endsection