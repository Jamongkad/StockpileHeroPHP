<html>
    <head>
        <title>StockpileHero</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"> 
        <meta name="csrf-token" content="{{ csrf_token() }}" />

    </head>
    <body id="app" class="nav-md">
        <div class="container body">
            <? if(Auth::check()): ?>
                <meta name="api-token" content="{{ Auth::user()->api_token }}" />
                <meta name="company-id" content="{{ Auth::user()->company_id }}" />
                @include('home.navbar')
                @include('home.sidebar')
            <? endif ?>
            @yield('content')
        </div> 
        <? if(Auth::check()): ?>
            <footer>
                <div class="pull-right">
                    StockpileHero - A simple way to keep track of your inventory.
                </div>
                <div class="clearfix"></div>
            </footer>
        <? endif ?>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
