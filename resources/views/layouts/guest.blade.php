<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="">
    
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#013b4f]">
        <img src="{{ asset('logo-login.png') }}" alt="logo">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-[#00c0a8] shadow-md overflow-hidden sm:rounded-lg">
               
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
