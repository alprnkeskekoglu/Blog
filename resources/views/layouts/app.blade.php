<!DOCTYPE html>
<html lang="en">
<head>

    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.png">


    <link rel="stylesheet" href="{!! asset("assets/css/animate.css") !!}">
    <link rel="stylesheet" href="{!! asset("assets/bootstrap/css/bootstrap.min.css") !!}">
    <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{!! asset('/assets/css/ionicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('/assets/css/themify-icons.css') !!}">
    <link rel="stylesheet" href="{!! asset('/assets/css/linearicons.css') !!}">
    <link rel="stylesheet" href="{!! asset('/assets/css/all.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('/assets/owlcarousel/css/owl.carousel.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('/assets/owlcarousel/css/owl.theme.css') !!}">
    <link rel="stylesheet" href="{!! asset('/assets/owlcarousel/css/owl.theme.default.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('/assets/css/magnific-popup.css') !!}">
    <link rel="stylesheet" href="{!! asset('/assets/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('/assets/css/responsive.css') !!}">

    <style>
        .breadcrumb-item.active {
            color: #FF324D
        }
    </style>
    @stack('styles')
</head>
<body>

@include('layouts.header')

@yield('content')

@include('layouts.footer')


<script src="{!! asset('/assets/js/jquery-1.12.4.min.js') !!}"></script>
<script src="{!! asset('/assets/bootstrap/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('/assets/owlcarousel/js/owl.carousel.min.js') !!}"></script>
<script src="{!! asset('/assets/js/magnific-popup.min.js') !!}"></script>
<script src="{!! asset('/assets/js/isotope.min.js') !!}"></script>
<script src="{!! asset('/assets/js/jquery.appear.js') !!}"></script>
<script src="{!! asset('/assets/js/jquery.parallax-scroll.js') !!}"></script>
<script src="{!! asset('/assets/js/sticky-kit.min.js') !!}"></script>
<script src="{!! asset('/assets/js/scripts.js') !!}"></script>

@stack('scripts')
</body>
</html>
