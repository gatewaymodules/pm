<div class="form-group">
    {!! Form::label('name', 'Task Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('assigned_to', 'Assigned To') !!}
    {!! Form::select(
    'assigned_to[]',
    $users,
    $task->getUserIds(),
    ['multiple' =>'true',
    'class' => 'form-control',
    'size' =>'7x1']
    ) !!}
</div>

<div>
    {!! Form::label('due_at', 'Due') !!}
    {!! Form::text('due_at',
     $due_at_default,
    ['class' => 'form-control',
    'id' => 'datetimepicker']) !!}
</div>

<div class="checkbox">
    <label>
        {!! Form::hidden('priority',0) !!}
        {!! Form::checkbox('priority') !!} Priority
    </label>
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea(
    'description',
    null,
    ['size' =>'1x3', 'class' => 'form-control']) !!}
</div>

<div class="checkbox">
    <label>
        {!! Form::hidden('milestone',0) !!}
        {!! Form::checkbox('milestone') !!} Milestone
    </label>
</div>

{!! Form::hidden('old_task_status', $old_task_status) !!}

<div class="checkbox">
    <label>
        {!! Form::hidden('completed',0) !!}
        {!! Form::checkbox('completed') !!} Completed
    </label>
</div>

<div class="form-group">
    {!! Form::label('slug', 'URL') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}


