<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Manager</title>

    <!-- Special style to make table rows clickable -->
    <style>
        table#table-clickable table td:hover {
            cursor: pointer;
        }
    </style>

    <link rel="stylesheet" href="/css/search.css">

    <link rel="stylesheet" href="/css/normalize.css">

    <!-- Bootstrap minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Used by date picker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- Used by date time picker -->
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.css">

    <!-- Bootstrap theme -->
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    -->

    <!-- Our special rounded include table -->
    <style>
        .gm-rounded-table {
            padding-top: 0px;
            background-color: #fff;
            border-color: #ddd;
            border-width: 1px;
            border-radius: 4px 4px 0 0;
            border-style: dotted;
            padding-bottom: 20px;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- Bootstrap disable URL printing -->
    <!-- http://stackoverflow.com/questions/7301989/need-to-remove-href-values-when-printing-in-chrome -->
    <style>@media print{a[href]:after{content:none}}</style>

</head>
<body>

@include('menu')

<div class="container gm-rounded-table">
    @if (Session::has('message'))
        <div class="flash alert-info">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class='flash alert-danger'>
            @foreach ( $errors->all() as $error )
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    @yield('content')
</div>

<br>
<small><p align="center"><a href='/project/feedback/tasklist/suggestions/task/create'>Feedback</a></p></small>

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- jQuery UI used for...? -->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="//twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
<script src="/js/bootstrap-datetimepicker.js"></script>

<!-- Full calendar includes -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

@yield('javascript')

<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
                    startDate: "1970-01-01",
                    autoclose: true,
                    todayBtn: true,
                    todayHighlight: true,
                    format: 'yyyy-mm-dd hh:ii',
                    pickerPosition: 'bottom-right'
                }
        );
        // Make zebra table rows clickable (the whole row)
        $('#table-clickable tbody tr').click(function () {
            var href = $(this).find("a").attr("href");
            if (href) {
                window.location = href;
            }
        });
    });

    //
    $("#name").bind('keyup', function (e) {
        $("#slug").val(($("#name").val()).replace(/\W+/g, '-').toLowerCase());
    });

    var the_tasks = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/queryTasks?name=%QUERY',
            wildcard: '%QUERY'
        }
    });

    var the_lists = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/queryTasklists?name=%QUERY',
            wildcard: '%QUERY'
        }
    });

    var the_projects = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/queryProjects?name=%QUERY',
            wildcard: '%QUERY'
        }
    });

    $('#multiple-datasets .typeahead').typeahead({
                highlight: true
            },
            {
                name: 'my-tasks',
                minLength: 3,
                display: 'name',
                source: the_tasks,
                templates: {
                    empty: ['<h4 class="item-type-name">Tasks</h4><div class="empty-message">No task results</div>'],
                    header: '<h4 class="item-type-name">Tasks</h4>'
                }
            },
            {
                name: 'my-lists',
                minLength: 3,
                display: 'name',
                source: the_lists,
                templates: {
                    empty: ['<h4 class="item-type-name">Lists</h4><div class="empty-message">No task list results</div>'],
                    header: '<h4 class="item-type-name">Lists</h4>'
                }
            },
            {
                name: 'my-projects',
                minLength: 3,
                display: 'name',
                source: the_projects,
                templates: {
                    empty: ['<h4 class="item-type-name">Projects</h4><div class="empty-message">No project results</div>'],
                    header: '<h4 class="item-type-name">Projects</h4>'
                }
            }
    );

    $('input[name=name]').on('typeahead:selected', function (evt, item) {
        $('#tasklist').val(item.id);
        $('#type').val(item.type);
    });

</script>

</body>
</html>
