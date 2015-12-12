<!doctype html>
<html>
<head>
    <title>
        @yield('title') - Summiteer
    </title>

    <meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700|Playfair+Display:400,400italic' rel='stylesheet' type='text/css'>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/summiteer.css" rel="stylesheet">

    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')

</head>
<body>

    @if(Session::get('flash_message') != null)
        <div class="flash_message">{{ Session::get('flash_message') }}</div>
    @endif


    <header>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainmenu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <img alt="Summiteer" src="/img/summiteer.png" width="443" height="74" class="hidden-xs">
                        <img alt="Summiteer" src="/img/summiteer_logo.png" width="133" height="74" class="visible-xs-block">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="mainmenu">
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                            <li><a href="/about">About</a></li>
                            <li><a href="/peaks">Peaks</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i> {{ Auth::user()->first_name ?  Auth::user()->first_name : Auth::user()->username }} <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/hikes">Your hikes</a></li>
                                    <li><a href="/hikes/log">Log a hike</a></li>
                                    <li><a href="/user/edit/{{ Auth::user()->username }}">Settings</a></li>
                                    <li><a href="/logout">Log out</a></li>
                                </ul>
                            </li>
                        @else
                            <li><a href="/about">About</a></li>
                            <li><a href="/peaks">Peaks</a></li>
                            <li><a href="/login">Log in</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    

    <section>

        {{-- Main page content will be yielded here --}}
        @yield('content')
    </section>

    <footer>
        <p>Rebekah Heacock Jones, 2015 | <a href="http://github.com/rebekahheacock/dwa15-p4">code on github</a></p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')

</body>
</html>