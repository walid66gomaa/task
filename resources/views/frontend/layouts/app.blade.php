<!DOCTYPE html>
@php
    $direction = 'ltr';
@endphp


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{$direction}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <meta name="keywords" content="@yield('meta_keywords', '')">
    <meta name="description" content="@yield('meta_description', '')">
    <meta name="robots" content="all">

    <meta property="og:site_name" content=" ">
    <meta property="og:title" content=" ">
    <meta property="og:description" content="@yield('meta_description', '')">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://picsum.photos/250/250">
    {{--    <meta property="og:url" content="https://amr.com">--}}

    @yield('meta')
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}"/>

    @stack('before-styles')

    <link rel="stylesheet" href="{{asset('assets-rtl/css/bootstrap.min.css')}}">
   
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet" type="text/css"/>

    @stack('after-styles')
</head>

<body class="{{$direction}}" class="page-top">



<div id="app">
  
    @include('frontend.includes.nav')

    @include('includes.partials.messages')
    
    @guest
        @include('frontend.layouts.modals.loginModal')
    @endguest

    @yield('content')

    @include('frontend.includes.footer')
</div>{{-- #app  --}}

{{-- Scripts  --}}



@stack('before-scripts')

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.5.4/dist/js/uikit-icons.min.js"></script>

<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/frontend.js') }}"></script>




@stack('after-scripts')

</body>
</html>
