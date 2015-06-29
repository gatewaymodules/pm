@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    @if ($logs->count())
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>User</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{!! nl2br(($log->description)) !!}</td>
                                    <td>{{ $log->user->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    @else
                        There are no log events
                    @endif


                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
