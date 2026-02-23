<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <a href="{{ route('home.index') }}">{{ __('Convoforum') }}</a>
        </h2>
    </x-slot>

    <div class="mx-auto">
        @forelse ($posts as $post)
            <div class="flex flex-col">
                <h2>{{ $post->topic->title }}</h2>
                <p>{{ $post->content }}</p>
                <div class="flex flex-row justify-between">
                    <p>{{ $post->user->name }}</p>
                    <p>{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <h3 class="text-center">Sorry, there are no any post yet</h3>
        @endforelse
        <div>
            <a href="{{ route('post.create') }}">Add new post</a>
        </div>
    </div>

</x-app-layout>
