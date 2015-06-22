@extends('app')

@section('content')

    @if ( !$user->hasRole('owner') )
        Is not owner
    @else
        Is owner
    @endif

@endsection