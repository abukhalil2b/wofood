<!DOCTYPE html>
<html dir="rtl" lang="ar">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="">
        <div class="min-h-screen bg-[#003b4f] text-[#fff]">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <div class="py-5 w-full flex justify-center">
            <img src="{{ asset('logo-login.png') }}" alt="logo" width="70">
            </div>
        </div>

        @livewireScripts
    </body>
</html>
