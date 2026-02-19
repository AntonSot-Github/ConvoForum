<header class="bg-white shadow-md">
    <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home.index') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition">
            ConvoForum
        </a>
        <div class="space-x-6 flex">
            <a href="#" class="text-gray-600 hover:text-blue-500">Темы</a>

            @if (isset(auth()->user()->name))
                <div class="flex">

                    <p>Hello, {{ auth()->user()->name }}
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="photo"
                            class="w-6 h-6t rounded-full object-cover inline-block mr-2">
                    </p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            @else
                <a href="#"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Вход</a>
                <a href="{{ route('user.create') }}"
                    class="text-blue-600 border border-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition">Register</a>
            @endif

        </div>
    </nav>
</header>
