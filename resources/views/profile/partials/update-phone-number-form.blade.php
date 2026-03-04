<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Phone Number') }}
        </h2>
    </header>

    <form method="post" action="{{ route('profile.update.phone') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <x-input-label for="update_phone_number" :value="__('Phone number')" />
            <x-text-input id="update_phone_number" 
                name="phone" type="tel" 
                class="mt-1 block w-full" 
                {{-- pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" --}}
                value="{{ old('phone', auth()->user()->phone) }}" />
            
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

        </div>
    </form>
</section>
