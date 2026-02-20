<header class="bg-white shadow-md">
    <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home.index') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition">
            ConvoForum
        </a>
        <div class="space-x-6 flex">
            

            @if (isset(auth()->user()->name))
                <div class="flex">

                    <p class="my-auto me-4">Hello, {{ auth()->user()->name }}</p>


                    <div>
                        <div class="relative inline-block text-left">
                            <input type="checkbox" id="menu-toggle" class="hidden peer">

                            <label for="menu-toggle"
                                class="flex items-center justify-center p-2 text-gray-600 cursor-pointer bg-white border border-gray-200 rounded-lg hover:bg-gray-50 select-none">
                                <svg class="w-6 h-6 peer-checked:hidden" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </label>

                            <div
                                class="absolute right-0 z-50 hidden w-56 mt-2 origin-top-left bg-white border border-gray-100 rounded-xl shadow-xl peer-checked:block p-1">
                                <div class="py-1 px-1 flex flex-col ">

                                    <div class="flex flex-col  w-full ">
                                        {{-- Avatar --}}
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="photo"
                                            class="w-8 h-8 rounded-full object-cover inline-block mx-auto mb-1">
                                        <p class="text-xs text-purple-500 text-center">{{ auth()->user()->email }}</p>
                                    </div>
                                    {{-- Menu for user --}}
                                    <div class="my-1 border-t border-gray-100"></div>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-indigo-50">Profile</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 rounded-lg hover:bg-indigo-50">Settings</a>
                                    <div class="my-1 border-t border-gray-100"></div>
                                    
                                    {{-- Logout-button --}}
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button
                                            class=" group w-full flex items-center px-4 py-2 text-sm font-medium text-gray-600 transition-all duration-200 rounded-lg hover:bg-red-50 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1"
                                            type="submit">
                                            <svg class="w-5 h-5 mr-2 text-gray-400 transition-colors duration-200 group-hover:text-red-500"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Logout</span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('user.login') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Login</a>
                <a href="{{ route('user.create') }}"
                    class="text-blue-600 border border-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition">Register</a>
            @endif

        </div>
    </nav>
</header>
