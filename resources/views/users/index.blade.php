<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <a href="{{ route('home.index') }}">{{ __('Convoforum') }}</a>
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 space-y-4 pb-6">

        @if ($users->isNotEmpty())
            <div class="w-full sm:w-2/3 md:w-3/5 lg:w-2/3 xl:w-2/5 mx-auto">
                <form method="GET" action="{{ route('users.index') }}" class="mb-4 flex flex-row">
                    <input type="text" name="search" placeholder="Search user..."
                        class="border rounded px-3 py-2 w-full me-1">
                    <x-button color="slate" value="{{ request('search') }}">
                        Search
                    </x-button>
                </form>
            </div>
        @endif


        <div class="overflow-x-auto rounded-xl border border-slate-200 shadow-sm">
            <table class="w-full text-sm text-left text-slate-500 flex flex-col">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200  w-full">
                    <tr class="grid grid-cols-3 grid-rows-1 py-3 px-4">
                        <th class="justify-self-start">User</th>
                        <th class="justify-self-center">Date of registration</th>
                        <th class="justify-self-end">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($users as $user)
                        <tr
                            class="bg-white transition-colors grid grid-cols-3 grid-rows-1 py-2 px-4 align-content-center">
                            <td class="justify-self-start my-auto">
                                <div class="flex flex-row justify-start">
                                    <img class="size-5 me-3 rounded-full my-auto"
                                        src="{{ asset('storage/' . $user->avatar) }}" alt="ava">
                                    <a href="{{ route('users.show', $user) }}" class="my-auto">{{ $user->name }}</a>
                                </div>

                            </td>
                            <td class="justify-self-center my-auto">
                                <p>{{ $user->created_at->format('d.m.Y') }}</p>
                            </td>
                            <td class="justify-self-end my-auto">
                                <form action="{{ route('user.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <x-button color="red" onclick="return confirm('Are you sure?')">
                                        Delete user
                                    </x-button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <h2>There are no any users yet</h2>
                    @endforelse
                </tbody>
            </table>
        </div>



    </div>
    <x-slot name="footer">
        <div class="w-full bg-white/70 border-b border-t">
            <div class="max-w-7xl mx-auto border-slate-200  backdrop-blur flex justify-between px-4 py-3">
                <div class="mx-auto">{{ $users->links() }}</div>
            </div>
        </div>
    </x-slot>



</x-app-layout>
