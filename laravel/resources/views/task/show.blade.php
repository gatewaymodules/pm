@extends('app')

@section('content')

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <!--
    http://www.findalltogether.com/wp/webdevelopment/framework/laravel/simple-blog-application-in-laravel-5-part-5-add-tinymce-and-user-profile/
    -->

    <script type="text/javascript">
        tinymce.init({
            menubar: false,
            statusbar: false,
            toolbar: false,
            forced_root_block: false,
            selector: "textarea"
        });
    </script>

    <!--
    <script type="text/javascript">
        tinymce.init({
            selector : "textarea",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
    -->

    <h3>{{ $task->name }}
        <small>Task</small>
        {!! link_to_route('project.tasklist.task.edit', 'Edit', array($project->slug,
        $tasklist->slug, $task->slug), array('class' => 'btn btn-sm btn-info')) !!}
    </h3>

    <ol class="breadcrumb">
        <li><a href="/project/">Projects</a></li>
        <li><a href="{{ route('project.show', [$project->slug]) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('project.tasklist.show', [$project->slug, $tasklist->slug]) }}">{{ $tasklist->name }}
                </a></li>

    </ol>

    <table class="table table-bordered table-striped">
        <tr>
            <td>
                Created
            </td>
            <td>
                {{ $task->created_at }} ({{  ($task->created_at()) }}) by {{ App\User::find($task->user_id)->name() }}
            </td>
        </tr>
        @if ($task->users->count() )
            <tr>
                <td>
                    Assigned to
                </td>
                <td>
                    @foreach ($task->users as $user) {{ $user->name()  }}, @endforeach
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
        @if ($task->due_at && $task->due_at <> "0000-00-00 00:00:00")
            <tr>
                <td>
                    Due
                </td>
                <td>
                    {{ $task->due_at }} ({{  ($task->due_at()) }})
                    @if ($task->due_at <= \Carbon\Carbon::now()->subHours(2) )
                        <font color="red">OVERDUE</font>
                    @endif
                </td>
            </tr>
        @endif
    </table>

    @if (Auth::user()->hasRole('admin') && config('projectmanager.superusermode'))
        <br>

        {!! Form::open(array('method'=> 'DELETE', 'route' => array('project.tasklist.task.destroy', $project->slug,
        $tasklist->slug, $task->slug))) !!}
        {!! Form::submit('Delete', array('class'=> 'btn btn-danger')) !!}
        {!! Form::close() !!}
    @endif

    {!! Form::model($task, ['method'=>'POST','route' => ['project.tasklist.task.comment.store', $project->slug, $tasklist->slug, $task->slug], 'class'=>'']) !!}
    <div class="form-group">
        {!! Form::textarea(
        'comment',
        null,
        ['size' =>'1x3', 'class' => 'form-control', 'placeholder' => 'Write a comment']) !!}
    </div>

    {!! Form::hidden('task_id', $id) !!}
    {!! Form::hidden('user_id', Auth::user()->id) !!}
    {!! Form::submit('Comment', ['class' => 'btn btn-default']) !!}
    {!! Form::submit('Comment & Notify', ['name' => 'comment_and_notify', 'class' => 'btn btn-default']) !!}
    {!! Form::submit('Postpone 24 Hours', ['name' => 'postpone', 'class' => 'btn btn-default']) !!}
    {!! Form::submit('Complete Task', ['name' => 'complete_task', 'class' => 'btn btn-default']) !!}
    {!! Form::close() !!}

    <hr>

    @if ($task->comments)
        @foreach ($task->comments as $comment)

            "{!! nl2br(($comment->comment)) !!}"
            <br>
            <small>
                <img src="{{ $comment->user['avatar'] }}">
                <i> - {{ $comment->user['name'] }} ({{ $comment->created_at() }})</i>
            </small>
            <br>
        @endforeach
    @endif

@endsection

@section('javascript')

    <!-- Script to put the focus on the comment field - does not work as of 10 July 2015 -->
    <script>
        $(function () {
            $("#comment").focus();
        });
    </script>

@endsection