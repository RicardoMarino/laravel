<!DOCTYPE html>
<html lang="en" ng-app="app">
    <head>
        <meta charset="utf-8">
        <title> Gestor de Projetos </title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        @if(Config::get('app.debug'))
            <link href="{{ URL::asset('build/css/vendor/font-awesome.min.css')}}" rel="stylesheet"/>
            <link href="{{ URL::asset('build/css/app.css')}}" rel="stylesheet"/>
            <link href="{{ URL::asset('build/css/components.css')}}" rel="stylesheet"/>
            <link href="{{ URL::asset('build/css/flaticon.css')}}" rel="stylesheet"/>
        @else
            <link href="{{ elixir('css/all.css')}}" type="text/css" rel="stylesheet"/>
        @endif

        <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="{{ URL::asset('build/img/favicon/favicon.ico')}}" type="image/x-icon">

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Laravel</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}">Home</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li><a href="{{ url('/auth/login') }}">Login</a></li>
                            <li><a href="{{ url('/auth/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div ng-view></div>
        <footer>
            <!-- Scripts -->
            @if(Config::get('app.debug'))
                <script src="{{'build/js/vendor/jquery.min.js'}}"></script>
                <script src="{{'build/js/vendor/angular.min.js'}}"></script>
                <script src="{{'build/js/vendor/angular-route.min.js'}}"></script>
                <script src="{{'build/js/vendor/angular-resource.min.js'}}"></script>
                <script src="{{'build/js/vendor/angular-messages.min.js'}}"></script>
                <script src="{{'build/js/vendor/ui-bootstrap-tpls.min.js'}}"></script>
                <script src="{{'build/js/vendor/navbar.min.js'}}"></script>
                <script src="{{'build/js/vendor/ng-file-upload.min.js'}}"></script>

                <script src="{{ asset('build/js/vendor/angular-cookies.min.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/vendor/query-string.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/vendor/angular-oauth2.min.js') }}" type="text/javascript"></script>


                <script src="{{ asset('build/js/app.js') }}" type="text/javascript"></script>

                <!-- Controllers -->
                <script src="{{ asset('build/js/controllers/home.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/login.js') }}" type="text/javascript"></script>

                <script src="{{ asset('build/js/controllers/client/clientList.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/client/clientNew.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/client/clientEdit.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/client/clientRemove.js') }}" type="text/javascript"></script>

                <script src="{{ asset('build/js/controllers/project/projectList.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/project/projectRemove.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/project/projectEdit.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/project/projectNew.js') }}" type="text/javascript"></script>


                <script src="{{ asset('build/js/controllers/project-note/projectNoteList.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/project-note/projectNoteRemove.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/project-note/projectNoteEdit.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/project-note/projectNoteNew.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/controllers/project-note/projectNoteShow.js') }}" type="text/javascript"></script>

                <!-- Filters -->
                <script src="{{ asset('build/js/filters/date-br.js') }}" type="text/javascript"></script>

                <!-- Services -->
                <script src="{{ asset('build/js/services/client.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/services/project.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/services/projectNote.js') }}" type="text/javascript"></script>
                <script src="{{ asset('build/js/services/user.js') }}" type="text/javascript"></script>
            @else
                <script src="{{elixir('js/all.js')}}"></script>
            @endif
        </footer>
        <!--[if IE 8]>

        <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

        <![endif]-->
    </body>
</html>