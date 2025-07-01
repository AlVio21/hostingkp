<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aplikasi PT Centradist Partsindo Utama Palembang</title>
    
    <!-- CoreUI CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="flex flex-col h-screen">
        <!-- Header -->
        @include('layouts.navigation')

        <!-- Main Content -->
        <div class="flex-1">
            @isset($header)
                <header class="bg-soft-blue text-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="bg-mint-green text-gray-800 p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
