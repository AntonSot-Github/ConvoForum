<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <a href="{{ route('home.index') }}">{{ __('Convoforum') }}</a>
        </h2>
    </x-slot>

    <div class="w-1/3 mx-auto">

        @forelse ($topics as $topic)
            <div class="flex flex-row mb-2 justify-between">
                <div class="flex flex-row ">
                    <img class="size-8 me-2 rounded-full" src="{{ asset('storage/' . $topic->user->avatar) }}"
                        alt="ava">
                    <a class="my-auto me-2" href="{{ route('topic.show', $topic) }}">{{ $topic->title }}</a>
                    <p class="my-auto">({{ $topic->posts_count }} posts)</p>
                </div>
                <div>
                    <p>{{ $topic->created_at->format('d M Y') }}</p>
                </div>

            </div>
        @empty
            <p>There are no any topics yet</p>
        @endforelse

    </div>

    <x-slot name="footer">
        <div class="w-full border-t-2 border-indigo-500 flex flex-row justify-between px-5 py-2">
            <p>Topics: {{ $topics->count() }}</p>
            <div>{{ $topics->links() }}</div>
            <p>Posts: {{ $posts->count() }}</p>
        </div>
    </x-slot>
</x-app-layout>
