<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<meta name="description" content="">
<meta name="keywords" content="">

<meta name="author" content="BOUHACIDA Ibrahim">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">


<script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    
<!--<title>{{ config('app.name', 'Laravel') }}</title>-->
    <title>@yield('title')</title>

    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div>
        @include('partials.menu')
        
        <div class="container">
    
        <div class="row">
        <div class="col-md-8 offset-md-2">
        @include('partials.flash')
        </div></div>
        
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    
    @yield('javascripts')
    
    </body>
</html>
