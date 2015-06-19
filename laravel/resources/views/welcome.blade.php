<html>
<head>
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            color: #B0BEC5;
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
        <div class="title">ISP Scripts 3.0</div>
        <br>
        <div class="quote">{{ Inspiring::quote() }}</div>
        <br><br>

        <div>
            <button type="button" class="btn btn-default navbar-btn" data-target="/projects">Sign in</button>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script>
$('.btn').on('click', function(event) {
event.preventDefault();
var url = $(this).data('target');
location.replace(url);
});
</script>
</body>
</html>
