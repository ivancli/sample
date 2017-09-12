<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>
        @yield('title', 'Home')
    </title>

    <link href="{{asset('/css/vendors.css')}}" rel="stylesheet">

    <link href="{{asset('/css/main.css')}}" rel="stylesheet">

    @yield('styles')

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>

<body>




<div class="wrapper">

    @include('partials.navbar-default')

    @yield('sub-header')

    <div class="container" role="main">

        @yield('content')

    </div> <!-- /container -->
</div>

<script src="{{asset('/js/vendors.js')}}"></script>
<script src="{{asset('/js/main.js')}}"></script>
@yield('scripts')
</body>
</html>
