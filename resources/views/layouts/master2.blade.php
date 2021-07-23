<!DOCTYPE html>
<html lang="en">
<head>
<meta name ="description" content="">
<meta name ="keyword" content="">
<meta name ="author" content="">

    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

</head>
<body>

<div>
@include('partials.menu')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        @include('partials.flash')
        </div>
    </div>
</div>
<main class="py-4">
            @yield('content')
        </main>
</div>

<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
@yield('javascripts')
</body>
</html>
