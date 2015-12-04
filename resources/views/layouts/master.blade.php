<!doctype html>
<html>
<head>
    <title>
        @yield('title') - PeakLogger
    </title>

    <meta charset='utf-8'>
    <link href="/css/peaklogger.css" type='text/css' rel='stylesheet'>

    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')

</head>
<body>

    @if(Session::get('flash_message') != null)
        <div class='flash_message'>{{ Session::get('flash_message') }}</div>
    @endif

    <nav>
    <ul>
        @if(Auth::check())
            <li><a href='/'>Home</a></li>
            <li><a href='/hike/log'>Log a hike</a></li>
            <li><a href='/logout'>Log out</a></li>
        @else
            <li><a href='/'>Home</a></li>
            <li><a href='/login'>Log in</a></li>
            <li><a href='/register'>Register</a></li>
        @endif
    </ul>
</nav>

    <header>
        <h1>@yield('title','PeakLogger')</h1>
    </header>

    <section>
        {{-- Main page content will be yielded here --}}
        @yield('content')
    </section>

    <footer>
        &copy; {{ date('Y') }}
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')

</body>
</html>