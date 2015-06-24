<div class="form-group">
{!! Form::label('name', 'Name') !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
{!! Form::text('due_at', '', array('id' => 'datepicker')) !!}
</div>

<div>
    {!! Form::text('date', null, array('type' => 'text', 'class' => 'form-control datepicker','placeholder' => 'Pick the date this task should be completed', 'id' => 'calendar')) !!}
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


