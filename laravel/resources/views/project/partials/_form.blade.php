<div class="form-group">
    {!! Form::label('name', 'Project Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('assigned_to', 'Members') !!}
    {!! Form::select(
    'assigned_to[]',
    $users,
    $project->getUserIds(),
    ['multiple' =>'true',
    'class' => 'form-control',
    'size' =>'7x1']
    ) !!}
</div>

<div class="form-group">
    {!! Form::label('sort_order', 'Sort Order') !!}
    {!! Form::text('sort_order', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'URL') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}