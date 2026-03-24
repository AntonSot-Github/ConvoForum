<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <a href="{{ route('home.index') }}">{{ __('Convoforum') }}</a>
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 space-y-4 pb-6">

        {{-- Search form --}}
        @if ($topics->isNotEmpty())
            <div class="w-full sm:w-2/3 md:w-3/5 lg:w-2/3 xl:w-2/5 mx-auto">
                <form method="GET" action="{{ route('topics.list') }}" class="mb-4 flex flex-row">
                    <input type="text" name="search" placeholder="Search topics..."
                        class="border rounded px-3 py-2 w-full me-1">
                    <x-button color="slate" value="{{ request('search') }}">
                        Search
                    </x-button>
                </form>
            </div>
        @endif

        {{-- List of topics --}}
        <div class="overflow-x-auto rounded-xl border border-slate-200 shadow-sm">

            
                <table class="w-full text-sm text-left text-slate-500 flex flex-col">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200  w-full">
                        <tr
                            class="grid {{ auth()->user()?->isAdmin() ? 'grid-cols-3' : 'grid-cols-2' }} grid-rows-1 py-3 px-4">
                            <th class="justify-self-start ">Topic title</th>
                            <th class=" {{ auth()->user()?->isAdmin() ? 'justify-self-center' : 'justify-self-end' }}">
                                Creation date</th>

                            @if (Auth::user() && Auth::user()->isAdmin())
                                <th class="justify-self-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($topics as $topic)

                        <tr
                            class="bg-white transition-colors grid {{ auth()->user()?->isAdmin() ? 'grid-cols-3' : 'grid-cols-2' }} grid-rows-1 py-2 px-4 align-content-center">
                            <td class="justify-self-start my-auto">
                                <div class="flex flex-row ">
                                    <img class="size-8 me-2 rounded-full"
                                        src="{{ asset($topic->user->avatar ?? 'avatars/av_def.png') }}" alt="ava">
                                    <a class="my-auto me-2"
                                        href="{{ route('topic.show', $topic) }}">{{ $topic->title }}</a>
                                    @if ($topic->posts_count != 0)
                                        <p class="hidden sm:inline my-auto whitespace-nowrap">
                                            ({{ $topic->posts_count }}
                                            mes.)</p>
                                    @endif

                                </div>
                            </td>

                            <td
                                class="{{ auth()->user()?->isAdmin() ? 'justify-self-center' : 'justify-self-end' }} my-auto">
                                <p>{{ $topic->created_at->format('d M Y') }}</p>
                            </td>

                            @if (Auth::user() && Auth::user()->isAdmin())
                                <td class="justify-self-end my-auto">
                                    <form action="{{ route('topic.destroy', $topic) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <x-button color="red"
                                            onclick="return confirm('Deleting this topic will remove all its posts. Continue?')">
                                            Delete topic
                                        </x-button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
         
                
            
        </div>
        @if (!$topics->isNotEmpty())
            <p class="text-center py-3"><i>There are no any topics yet</i></p>
        @endif
        
    </div>

    <x-slot name="footer">
        <div class="w-full bg-white/70 border-b border-t">
            <div class="max-w-7xl mx-auto  border-slate-200  backdrop-blur flex justify-between px-4 py-3">
                <p>Topics: {{ $topics->total() }}</p>
                <div>{{ $topics->links() }}</div>
                <p>Posts: {{ $postsCount }}</p>
            </div>
        </div>
    </x-slot>
</x-app-layout>
