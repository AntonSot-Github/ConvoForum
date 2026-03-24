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

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-xl antialiased min-h-screen flex flex-col bg-white text-slate-800">
    <div class="min-h-screen dark:bg-gray-900 flex flex-col ">

        <!-- Page Heading -->
        @isset($header)
            <header class="w-full border-b border-slate-200 bg-slate-200 shadow-lg">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
                    {{ $header }}
                </div>
                <div class="bg-slate-100 py-1">
                    @include('layouts.navigation')
                </div>
            </header>
        @endisset



        <!-- Page Content -->
        <main class="w-full md:w-3/4 mx-auto grow mt-4">

            {{-- Messages about success or error --}}
            <x-flash-message></x-flash-message>
                {{ $slot }}
            

            @yield('content')

        </main>

        @isset($footer)
            <footer class="w-full bg-slate-200 text-slate-800 flex flex-col">

                {{ $footer }}

                <div class="mx-auto px-4 py-4 ">
                    <h2>&copy; {{ date('Y') }} ConvoForum</h2>
                </div>

            </footer>
        @endisset
    </div>
</body>
<script>
    /* Preview avatar before sending on server */
    document.getElementById('avatar_input').addEventListener('change', function(e) {

        const file = e.target.files[0];

        if (!file.type.startsWith('image/')) {
            alert('Please select an image');
            return;
        }

        if (!file) return;

        const preview = document.getElementById('avatar_preview');

        preview.src = URL.createObjectURL(file);

    });

    
</script>

</html>
