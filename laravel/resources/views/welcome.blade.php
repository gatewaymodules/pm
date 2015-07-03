<html>
<head>
    <title>Project Manager</title>
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            color: #000000;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
            margin-bottom: 40px;
        }

        .quote {
            font-size: 24px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">

        <div class="title">Project Manager</div>
        <br>

        <div class="quote">{{ Inspiring::quote() }}</div>

        <br><br>

        <legend>Sign in with</legend>

        <a href="/login/google" class="google-plus" title="Google"> <i class="fa fa-google fa-3x"></i> </a>
        <a href="/login/facebook" class="facebook" title="Facebook"> <i class="fa fa-facebook fa-3x"></i> </a>
        <a href="/login/github" class="github" title="GitHub"> <i class="fa fa-github fa-3x"></i> </a>

        @if (Session::has('message'))
            <br>
            <div class="flash alert-error">
                {{ Session::get('message') }}
            </div>
        @endif

    </div>
</div>

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script>
    $('.btn').on('click', function (event) {
        event.preventDefault();
        var url = $(this).data('target');
        location.replace(url);
    });
</script>
</body>
</html>
