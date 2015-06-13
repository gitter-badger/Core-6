<!doctype html>
<html>
    <head>
        <title></title>
        {{ HTML::link('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}
    </head>
    <body>
        @yield('content')
        {{ HTML::script('//ajax.googleapis.com/ajax/jquery/1.11.0/jquery.min.js') }}
        {{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js') }}
    </body>
</html>