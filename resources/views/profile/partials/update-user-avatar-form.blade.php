<section>
    <header>
        @if ($user->avatar)
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                {{ __('Your avatar') }}
            </h2>
        @endif

    </header>

    <form method="post" action="{{ route('profile.update.avatar') }}" class="mt-6 space-y-6 " enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <div class="size-24 mx-auto mb-6">
                @if ($user->avatar)
                    <img id="avatar_preview" class="rounded-xl mb-6" src="{{ asset('storage/' . $user->avatar) }}" alt="avatar-image">
                @endif
            </div>
            <x-input-label for="avatar_input" :value="__('Avatar')" />
            <x-text-input id="avatar_input" accept="image/*" name="avatar" type="file" class="mt-1 block w-full" />

        </div>

        <div class="flex flex-row justify-end gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
