<header class="bg-white shadow-md">



    <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home.index') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition">
            ConvoForum
        </a>
        <div class="space-x-6">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Login</a>
            <a href="{{ route('register') }}" class="text-blue-600 border border-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition">Registration</a>
        </div>
    </nav>
</header>
