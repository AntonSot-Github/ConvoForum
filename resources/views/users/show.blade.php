<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <a href="{{ route('home.index') }}">{{ __('Convoforum') }}</a>
        </h2>
    </x-slot>

    <div
        class="max-w-4xl mx-auto px-4 space-y-4 pb-6 flex flex-col bg-white border border-gray-400 rounded-2xl shadow-xl p-4 items-center">
        <img class="size-20 rounded-full my-auto" src="{{ asset($user->avatar) }}" alt="ava">
        <h1 class="text-3xl">{{ $user->name }}'s profile</h1>
        <div class="flex flex-row">
            <p class="me-3">{{ $user->email }}</p>
            @if ($user->email_verified_at)
                <p class="text-green-600">verified &#9989;</p>
            @else
                <p class="text-red-600">unverified &#10060;</p>
            @endif
        </div>

        @if ($user->phone)
            <p>{{ $user->phone }}</p>
        @endif

        <p>Registered &nbsp;&#8212;&nbsp; {{ $user->created_at->diffForHumans(['parts' => 2]) }}</p>

        {{-- Show delete button if the user is not one of admins --}}
        @if (Auth::user()->isAdmin() && !$user->isAdmin() && Auth::user()->id !== $user->id)
            <x-button color="red" onclick="return confirm('Are you sure?')">
                Delete user
            </x-button>
        @endif


    </div>

    <x-slot name="footer"></x-slot>

</x-app-layout>
