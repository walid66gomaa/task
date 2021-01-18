<!DOCTYPE html>
@php
    $direction = 'ltr';
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{$direction}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', ' ')">
    <meta name="author" content="@yield('meta_author', 'walid elbehery')">
    @if(config('favicon_image') != "")
        <link rel="shortcut icon" type="image/x-icon"
              href="{{asset('storage/logos/'.config('favicon_image'))}}"/>
    @endif
    @yield('meta')
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet"
          href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet"
          href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
    <link rel="stylesheet"
          href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>
    {{--<link rel="stylesheet"--}}
    {{--href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.min.css"/>--}}

    @stack('before-styles')

<!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    <link rel="stylesheet" href="{{asset('css/backend.css')}}">

    @stack('after-styles')

    @if($direction == 'ltr')
        <style>
            .float-left {
                float: right !important;
            }
            .float-right {
                float: left !important;
            }
        </style>
    @endif
</head>

<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
@include('backend.includes.header')
<div class="app-body">
    @include('backend.includes.sidebar')

    <main class="main">

        <div class="container-fluid" style="padding-top: 30px">
            <div class="animated fadeIn">
                <div class="content-header">
                    @yield('page-header')
                </div><!--content-header-->

                @include('includes.partials.messages')
                @yield('content')
            </div><!--animated-->
        </div><!--container-fluid-->
    </main><!--main-->

    {{--@include('backend.includes.aside')--}}
</div><!--app-body-->

@include('backend.includes.footer')

<!-- Scripts -->
@stack('before-scripts')
<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/backend.js') }}"></script>

<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="{{asset('js/pdfmake.min.js')}}"></script>
<script src="{{asset('js/vfs_fonts.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script src="{{asset('js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/main.js')}}" type="text/javascript"></script>
<script>
    window._token = '{{ csrf_token() }}';
</script>

@stack('after-scripts')

</body>
</html>
