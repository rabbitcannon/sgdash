<!doctype html>

<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SG TIcketing</title>

        <!-- Styles -->
        <link rel="stylesheet" href="/assets/css/app.css" />
        <link rel="stylesheet" href="/assets/css/login/login.css" />
        <link rel="stylesheet" href="/assets/css/animate.css" />

        <!-- Scripts -->
        <script src="/assets/js/app.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>

    <body>

        <section>
            @yield('content')
        </section>

    </body>
</html>