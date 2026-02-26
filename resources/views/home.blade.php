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
                    <div>
                        <img cclass="mt-3 rounded max-w-full" src="{{ asset('storage/' . $post->picture) }}" alt="img">
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
