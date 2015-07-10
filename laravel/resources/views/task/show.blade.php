@extends('app')

@section('content')

    <h3>{{ $task->name }} <small>Task</small>
    </h3>

    <ol class="breadcrumb">
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('project.tasklist.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}</a></li>
        <li class="active">{{  $task->name }}</li>
    </ol>

    <table class="table table-bordered table-striped">
        <tr><td>
                Created
            </td>
            <td>
                {{ $task->created_at()  }} by {{ App\User::find($task->user_id)->name }}
            </td>
        </tr>
        @if ($task->users )
            <tr>
                <td>
                    Assigned to
                </td>
                <td>
                    @foreach ($task->users as $user) {{ $user->name  }}, @endforeach
                </td>
            </tr>
        @endif
        @if ($task->description )
            <tr>
                <td>
                    Description
                </td>
                <td>
                    {!! nl2br(e($task->description)) !!}
                </td>
            </tr>
        @endif
    </table>

    {!! Form::model($task, ['method'=>'POST','route' => ['project.tasklist.task.comment.store', $project->slug, $tasklist->slug, $task->slug], 'class'=>'']) !!}
    <div class="form-group">
        {!! Form::textarea(
        'comment',
        null,
        ['size' =>'1x1', 'class' => 'form-control', 'placeholder' => 'Write a comment']) !!}
    </div>

    {!! Form::hidden('task_id', $id) !!}
    {!! Form::hidden('user_id', Auth::user()->id) !!}
    {!! Form::submit('Save comment', ['class' => 'btn btn-default']) !!}

    {!! Form::close() !!}

    <hr>

    @if ($task->comments)

    @foreach ($task->comments as $comment)
        {{ $comment->created_at() }}:
        {{ nl2br(e($comment->comment)) }}<small>
            <i> - {{ $comment->user['name'] }}</i>
        </small>
        <br>
    @endforeach

    @endif

@endsection

@section('javascript')

    <!-- Script to put the focus on the comment field -->
    <script>
        $(function () {
            $("#comment").focus();
        });
    </script>

@endsection