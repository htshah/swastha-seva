<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title') {{ config('app.name') }}</title>

    <!-- Fonts -->
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <style>
        .primary-color{
            background: #1976D2 !important;
        }
        
        .primary-text-color{
            color: #1976D2;
        }

        .no-padding-left{
            padding-left: 0 !important;
        }
        
        .secondary-navbar {
            padding: 20px 0;
            font-size: 16px;
            font-weight: 600;
            border-bottom: 1px solid #e4e4e4;
        }

        .no-margin{
            margin: 0 !important;
        }
        
        .small-margin{
            margin: 5px 0 !important;
        }
        
        select.browser-default {
            display: block;
            padding: 10px 5px;
            height: auto;
            font-size: 16px;
            border-radius: 5px;
        }

        .brand-logo{
            font-size: 1.5rem !important;
            font-weight: 500;
        }
        /* label focus color */
        .input-field input:focus + label {
        color: #1976D2 !important;
        }
        /* label underline focus color */
        .row .input-field input:focus {
        border-bottom: 1px solid #1976D2 !important;
        box-shadow: 0 1px 0 0 #1976D2 !important
        }

        /* .main-container{
            margin: 6rem 0;
        } */
    </style>
    @yield('styles')
</head>
<body class="grey lighten-5">
    @include('layouts.navbar')
    <div class="main-container">
        @yield('main-content')
    </div>
    
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script>

    @yield('scripts')
</body>
</html>