<div class="form-group">
{!! Form::label('name', 'Name') !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('slug', 'Slug') !!}
{!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<div class="checkbox">
<label>
{!! Form::hidden('completed',0) !!}
{!! Form::checkbox('completed') !!} Completed
</label>
</div>

<div class="form-group">
{!! Form::label('description', 'Description') !!}
{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit($submit_text, ['class' => 'btn btn-default']) !!}


