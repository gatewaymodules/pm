@extends('app')

@section('content')

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>

    <script type="text/javascript">
        tinymce.init({
            fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
            menubar : false,
            statusbar: false,
            forced_root_block: false,
            selector : "textarea",
            plugins : ["textcolor code autoresize"],
            toolbar : "forecolor fontsizeselect code"

        });
    </script>

    <h3>Edit user '{{ $user->name }}'</h3>

    <ol class="breadcrumb">
        <li><a href="/users/">Users</a></li>
        <li class="active">Edit Users</li>
    </ol>

    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id ]]) !!}
    @include('users/partials/_form', ['submit_text' => 'Edit User'])
    {!! Form::close() !!}

@endsection
