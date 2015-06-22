<table>
    <tr>
        <td align="right">{!! Form::label('name', 'Name:') !!}</td>
        <td>{!! Form::text('name') !!}</td>
    </tr>
    <tr>
        <td align="right">{!! Form::label('slug', 'Slug:') !!}</td>
        <td>{!! Form::text('slug') !!}</td>
    </tr>
    <tr>
        <td align="right">{!! Form::hidden('completed',0) !!} {!! Form::label('completed', 'Completed:') !!}</td>
        <td>{!! Form::checkbox('completed') !!}</td>
    </tr>
    <tr>
        <td align="right">{!! Form::label('description', 'Description:') !!}</td>
        <td>

                {!! Form::textarea('description') !!}

        </td>
    </tr>
    <tr>
        <td align="right"></td>
        <td>{!! Form::submit($submit_text) !!}</td>
    </tr>
</table>
