<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!--search engine optimisation-->
 <title>@yield('title')</title>
 <meta name="description" content="@yield('description')">
 <meta name="keywords" content="@yield('keywords')">
 <link rel="canonical" href="{{url()->current()}}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@if($LogoIcon))
<link rel="icon" href="{{ asset('storage/content_uploads/icons/'.$LogoIcon) }}" type="image/gif" sizes="20x16">
<link href="{{ asset('storage/content_uploads/icons/'.$LogoIcon) }}" rel="icon">
  <link href="{{ asset('storage/content_uploads/icons/'.$LogoIcon) }}" rel="apple-touch-icon">
@endif
    
  
    <!-- Fonts -->

    <script src="{{ asset('js/jquery.js') }}" defer></script>
    <!-- Styles -->
   <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />-->
<link href="{{ asset('css/global_style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/navigation.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom_slider_relative.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('css/custom_multi_slider.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('css/slide_show_format_2.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('css/lightbox_gallery.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/table_custom.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/modal-popup-light.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('css/custom_alert.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('css/custom_loader.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('css/responsive-custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('ionicons/css/ionicons.min.css') }}" />
</head>
<body>
    <div id="app">
       
      @include('includes.header')
   

        @yield('content')


        @include('includes.footer')
    

    </div>


<a href="#" class="scrollup" style="display: none;">Scroll</a>

   <!--<script src="{{ asset('js/jquery.min.js') }}" defer></script>-->
    <!--<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>-->


    <script src="{{ asset('custom_js/custom.js') }}" defer></script>
    <script src="{{ asset('custom_js/custom_loader.js') }}" defer></script>
<script src="{{ asset('custom_js/custom_alert.js') }}" defer></script>

<script src="{{ asset('custom_js/custom_slider_relative.js') }}" defer></script>

<script src="{{ asset('custom_js/custom_multi_slider.js') }}" defer></script>

<script src="{{ asset('custom_js/slide_show_format_2.js') }}" defer></script>

<script src="{{ asset('custom_js/lightbox_gallery.js') }}" defer></script>

    <script src="{{ asset('custom_js/custom-contact.js') }}" defer></script>
    <script src="{{ asset('custom_js/readmore.js') }}" defer></script>
    <script src="{{ asset('custom_js/readmore-less-items.js') }}" defer></script>
    <script src="{{ asset('custom_js/reviews_pagination.js') }}" defer></script>
    <script src="{{ asset('custom_js/modal-popup-light.js') }}" defer></script>
    <script src="{{ asset('custom_js/custom_search.js') }}" defer></script>



</body>
</html>
