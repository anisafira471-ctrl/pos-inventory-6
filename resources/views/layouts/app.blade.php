<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="margin: 0; background-color: #f8fafc;">
        <div style="display: flex; min-height: 100vh;">
            
            <!-- SIDEBAR KIRI (Memanggil Navigation) -->
            @include('layouts.navigation')

            <!-- KONTEN UTAMA DI KANAN -->
            <div style="margin-left: 220px; flex-grow: 1; display: flex; flex-direction: column; min-height: 100vh;">
                @isset($header)
                    <header style="background-color: white; border-bottom: 1px solid #e2e8f0; padding: 16px 24px;">
                        <div style="max-width: 100%;">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main style="flex-grow: 1; background-color: #f8fafc;">
                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>