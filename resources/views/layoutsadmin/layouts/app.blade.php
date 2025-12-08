<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if($LogoIcon))
<link rel="icon" href="{{ asset('storage/content_uploads/icons/'.$LogoIcon) }}" type="image/gif" sizes="20x16">
<link href="{{ asset('storage/content_uploads/icons/'.$LogoIcon) }}" rel="icon">
  <link href="{{ asset('storage/content_uploads/icons/'.$LogoIcon) }}" rel="apple-touch-icon">

@endif
    
    <!--This is the app name which is configured from .env file on APP_NAME.
These ouble double braces you see  work as echo, in laravel we do'nt use echo but we use those braces with in
 them, are your output.
 Also note that doing 'app.name','Bruno demo' we are like testing a condition forexample if app.name 
 not existing out put Bruno demo.
-->
<?php $title=$Brandname; ?>
<title>{{ config('app.name', '$title') }}</title>


<!--You can create your own custom js and css files in /public/js/custom.js  or  
/public/css/custom.css and reference them here as well-->
<!--contains required bootstrap js files-->
    <!-- Scripts -->
  
    <!-- Fonts -->

    <script src="{{ asset('js/jquery.js') }}" defer></script>
    <!-- Styles -->

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/table_custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/dynamicformelements.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    

       <link href="{{ asset('css/responsive-custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('ionicons/css/ionicons.min.css') }}" />

</head>
<body>
    <div id="app">


  


@include('includes.headercpanel')



            @yield('content')


    </div>





    @include('includes.footercpanel')
   


    <a href="#" class="scrollup" style="display: none;">Scroll</a>




    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    
    <script src="{{ asset('custom_js/custom.js') }}" defer></script>
    <!--<script src="{{ asset('custom_js/about.js') }}" defer></script>
    <script src="{{ asset('custom_js/service.js') }}" defer></script>-->
    <script src="{{ asset('custom_js/dynamicformelements.js') }}" defer></script>

    

</body>
</html>
