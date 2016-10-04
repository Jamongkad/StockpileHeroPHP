<html>
    <head>
        <title>StockpileHero</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"> 
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body id="app" class="nav-md">
        <div class="container body">
            @include('home.navbar')
            @include('home.sidebar')
            @yield('content')
        </div> 
        <footer>
          <div class="pull-right">
            StockpileHero - A simple way to keep track of your inventory.
          </div>
          <div class="clearfix"></div>
        </footer>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
