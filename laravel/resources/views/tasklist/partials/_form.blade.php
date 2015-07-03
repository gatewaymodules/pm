<div class="form-group">
        {!! Form::label('name', 'Task List Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea(
    'description',
    null,
    ['size' =>'1x3', 'class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'URL:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}
