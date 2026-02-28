<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <a href="{{ route('home.index') }}">{{ __('Convoforum') }}</a>
        </h2>
    </x-slot>


    <div class="max-w-4xl mx-auto px-4 py-8 space-y-6">
        @forelse ($posts as $post)
            <div
                class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">

                {{-- Topic of post --}}
                <h2 class="bg-slate-50 border-b border-slate-100 px-6 py-4">{{ $post->topic->title }}</h2>

                {{-- Post picture --}}
                @if ($post->picture)
                    <div class="relative mt-3">
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
                                class="max-w-[95vw] max-h-[95vh] object-contain shadow-2xl rounded-lg"
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
                    <p>{{ $post->user->name }}</p>
                    <time>{{ $post->created_at }}</time>
                </div>

            </div>
        @empty
            <div class="text-center py-12">
                <h3 class="text-xl text-slate-500 italic">Sorry, there are no posts yet</h3>
            </div>
        @endforelse

        @auth
            <div class="flex justify-center pt-4">
                <a href="{{ route('post.create') }}"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-full font-medium hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-200">
                    + Add new post
                </a>
            </div>
        @endauth
    </div>

</x-app-layout>
