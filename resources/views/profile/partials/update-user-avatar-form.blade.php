<section>
    <header>
        @if (auth()->user()->avatar)
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                {{ __('Your avatar') }}
            </h2>
        @endif

    </header>

    <form method="post" action="{{ route('profile.update.avatar') }}" class="mt-6 space-y-6 " enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <div class="size-24 mx-auto">
                @if (auth()->user()->avatar)
                    <img class="rounded-xl" src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="avatar-image">
                @endif
            </div>
            <x-input-label for="update_avatar" :value="__('Avatar')" />
            <x-text-input id="update_avatar" name="avatar" type="file" class="mt-1 block w-full" />

        </div>

        <div class="flex flex-row justify-end gap-4v">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
