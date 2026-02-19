<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'ConvoForum')</title>
</head>

<body class="h-screen flex flex-col ">

    @include('partials.header')

    <main class="container mx-auto mt-8 px-4 grow w-[60vw]">

        @include('partials.alert')

        @yield('content')

        <div>
            <a href="#">Add new post</a>
        </div>

    </main>

    @include('partials.footer')

</body>

</html>
