<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('firstname', 'First Name') !!}
    {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('phone', 'Phone') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('signature', 'Signature') !!}
    {!! Form::textarea('signature', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}
