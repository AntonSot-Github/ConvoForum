<nav x-data="{ open: false }" class="text-slate-600 hover:text-indigo-600 transition-colors">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">

        <div class="grid grid-row-1 grid-cols-2">

            <div class="my-auto">
                <div class="hidden sm:flex">
                    <!-- Navigation Links -->
                    <div class="hidden sm:-my-px sm:flex">
                        <x-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')">
                            {{ __('Main') }}
                        </x-nav-link>

                        <x-nav-link :href="route('topics.list')" :active="request()->routeIs('topics.list')">
                            <span class="whitespace-nowrap">{{ __('Topics menu') }}</span>
                        </x-nav-link>

                        @auth
                            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                                {{ __('Profile') }}
                            </x-nav-link>
                        @endauth

                        {{-- If user is autorized and the user is admin, show this menu tab --}}
                        @if (Auth::user() && Auth::user()->isAdmin())
                            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                                {{ __('List of users') }}
                            </x-nav-link>
                        @endif

                        @if ($topic = request()->route('topic'))
                            <x-nav-link :href="route('topic.show', $topic)" :active="request()->routeIs('topic.show')">
                                {{ __("Posts on $topic->title") }}
                            </x-nav-link>
                        @endif

                        @auth
                            @if (auth()->user()->isAdmin() && request()->route('user'))
                                @php
                                    $user = request()->route('user');
                                @endphp

                                <x-nav-link :href="route('users.show', $user)" :active="request()->routeIs('users.show')">
                                    {{ $user->name }}
                                </x-nav-link>
                            @endif
                        @endauth
                    </div>

                </div>

                <!-- Hamburger -->
                <div class=" flex sm:hidden relative mb-1">
                    <div class="-me-2 flex flex-col items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div :class="{ 'block': open, 'hidden': !open }"
                        class="hidden sm:hidden min-w-min absolute top-full left-0 z-50 bg-white shadow-xl rounded-b-lg border border-gray-100">
                        <div class="pt-2 pb-3 space-y-1">
                            <x-responsive-nav-link :href="route('home.index')">
                                {{ __('Main') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link :href="route('topics.list')" :active="request()->routeIs('topics.list')">
                                <span class=" whitespace-nowrap">{{ __('Topics menu') }}</span>
                            </x-responsive-nav-link>

                            @auth
                                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                                    {{ __('Profile') }}
                                </x-responsive-nav-link>
                            @endauth

                            {{-- If user is autorized and the user is admin, show this menu tab --}}
                            @if (Auth::user() && Auth::user()->isAdmin())
                                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                                    {{ __('List of users') }}
                                </x-responsive-nav-link>
                            @endif

                            @if ($topic = request()->route('topic'))
                                <x-responsive-nav-link :href="route('topic.show', $topic)" :active="request()->routeIs('topic.show')">
                                    {{ __("Posts on $topic->title") }}
                                </x-responsive-nav-link>
                            @endif

                            @auth
                                @if (auth()->user()->isAdmin() && request()->route('user'))
                                    @php
                                        $user = request()->route('user');
                                    @endphp

                                    <x-responsive-nav-link :href="route('users.show', $user)" :active="request()->routeIs('users.show')">
                                        {{ $user->name }}
                                    </x-responsive-nav-link>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @if (isset(Auth::user()->name))
                <!-- Settings Dropdown -->
                <div class="flex sm:items-end sm:ms-6 justify-end">

                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex flex-row">
                                    <img class="size-8 me-2 rounded-full"
                                        src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="">
                                    <p class="my-auto text-lg">{{ Auth::user()->name }}</p>
                                </div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            {{-- Profile edition menu --}}
                            <x-dropdown-link :href="route('profile.edit', auth()->user())">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            {{-- Logout-button --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>

                </div>
            @else
                <div class="w-full flex justify-end">

                    @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                            class="inline-block my-auto px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                            Log in
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block my-auto px-5 py-1.5 dark:text-[#EDEDEC] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif

                </div>
            @endif

        </div>
    </div>
</nav>
