<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Online Course Provider</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
</head>
<body>




    @yield('content')




    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/axios.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
</body>
</html>