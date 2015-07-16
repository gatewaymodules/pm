@if (Auth::guest())
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Project Manager</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/auth/login">Login</a></li>
                    <li><a href="/auth/register">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
@else
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Project Manager</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        {!! Form::open(['url' => '/profile', 'method' => 'get']) !!}
                        <div id="multiple-datasets">
                            {!! Form::text('user', null, ['name'=>'name', 'class'=>'typeahead tt-input']) !!}
                            {!! Form::submit('GO') !!}
                        </div>
                        <div class="form-group">
                            <input name="tasklist" id="tasklist" type="text" class="form-control" placeholder="Tasklist">
                        </div>
                        <div class="form-group">
                            <input name="type" id="type" type="text" class="form-control" placeholder="Type">
                        </div>

                        {!! Form::close() !!}
                    </li>
                    <li><a href="/home">Dashboard</a></li>
                    <li><a href="/project">Projects</a></li>
                    <li><a href="/users">People</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/auth/logout">Logout</a></li>
                            <li><a href="/log/">Log</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif