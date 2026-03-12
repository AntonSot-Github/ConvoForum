<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <a href="{{ route('home.index') }}">{{ __('Convoforum') }}</a>
        </h2>
    </x-slot>


    <div class="max-w-4xl mx-auto px-4 space-y-4 pb-6">

        @auth
            <div class="flex justify-center">
                <a href="{{ route('post.create') }}"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-full font-medium hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-200">
                    + Add new post
                </a>
            </div>
        @endauth

        @forelse ($posts as $post)
            <div
                class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300">

                {{-- Topic of post --}}
                <h2 class="bg-slate-50 border-b border-slate-100 px-6 py-4 rounded-t-2xl">{{ $post->topic->title }}</h2>

                {{-- Post picture --}}
                @if ($post->picture)
                    <div class="relative">
                        <input type="checkbox" id="zoom-{{ $post->id }}" class="hidden peer">

                        <label for="zoom-{{ $post->id }}" class="cursor-zoom-in block">
                            <img src="{{ asset('storage/' . $post->picture) }}"
                                class="max-w-full hover:opacity-90 transition-opacity" alt="img">
                        </label>

                        <div
                            class="fixed inset-0 z-50 hidden peer-checked:flex items-center justify-center bg-black/90 p-4">

                            <label for="zoom-{{ $post->id }}"
                                class="absolute top-5 right-5 text-white bg-white/20 hover:bg-white/40 rounded-full p-3 cursor-pointer transition-colors">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </label>

                            <img src="{{ asset('storage/' . $post->picture) }}"
                                class="max-w-[90vw] max-h-[90vh] object-contain shadow-2xl rounded-lg"
                                alt="fullscreen-img">
                        </div>
                    </div>
                @endif

                {{-- Post-text --}}
                <div class="mb-3 p-6">
                    <pre class="text-slate-600 leading-relaxed">{{ $post->content }}</pre>
                </div>

                {{-- User's name and publication date --}}
                <div
                    class="flex flex-row justify-between items-center px-6 py-4 bg-slate-50/50 border-t border-slate-50 text-sm">

                    {{-- If the user is autor of the post, show the edition menu --}}
                    @auth
                        @if($post->user_id === auth()->id() || Auth::user()->isAdmin())
                            <x-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div @class(['flex flex-row', 'text-green-500' => $post->user->isAdmin()])>
                                            <img class="size-8 me-2 rounded-full"
                                                src="{{ asset('storage/' . $post->user->avatar) }}" alt="Avatar-img">

                                            @if ($post->user->isAdmin())
                                                <p class=" text-green-500 my-auto me-2">*Admin</p>
                                            @endif

                                            <p class="my-auto text-lg">{{ $post->user->name }}</p>
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

                                    <x-dropdown-link :href="route('post.edit', [$post])">
                                        Edit post

                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('post.delete', $post) }}">
                                        @csrf
                                        @method('DELETE')

                                        <x-dropdown-link href="#"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            Delete post
                                        </x-dropdown-link>
                                    </form>


                                </x-slot>
                            </x-dropdown>
                            {{-- Else show just post author's name --}}
                        @else
                            <p>{{ $post->user->name }}</p>
                        @endif
                    @endauth

                    <time>{{ $post->created_at->format('d M Y H:i') }}</time>
                </div>


            </div>
        @empty
            <div class="text-center py-12">
                <h3 class="text-xl text-slate-500 italic">Sorry, there are no any posts yet</h3>
            </div>
        @endforelse

        <x-slot name="footer">
            <div class="w-full border-t-2 border-indigo-500 flex flex-row justify-between px-5 py-2">
                <p>Topics: {{ $topics->count() }}</p>
                <div>{{ $posts->links() }}</div>
                <p>Posts: {{ $posts->total() }}</p>
            </div>
        </x-slot>

    </div>

</x-app-layout>
