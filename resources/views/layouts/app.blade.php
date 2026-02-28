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

<body class="font-sans antialiased min-h-screen flex flex-col">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">


        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="container w-full md:w-3/4 mx-auto grow">

            {{-- Messages about success or error --}}
            <x-flash-message />

            {{ $slot }}

            @yield('content')

        </main>

        @isset($footer)
            <footer class="w-full bg-white dark:bg-gray-800 shadow py-4 flex flex-col">

                <div class="w-full">
                    <h2 class="text-center">&copy; {{ date('Y') }} ConvoForum</h2>
                </div>

                {{ $footer }}

            </footer>
        @endisset
    </div>
</body>

</html>
