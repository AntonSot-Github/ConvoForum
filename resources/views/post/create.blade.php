<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <a href="{{ route('home.index') }}">{{ __('Convoforum') }}</a>
        </h2>
    </x-slot>

    <div>

        <form action="" method="POST" class="flex flex-col text-center">
            @csrf

            <div >
                <input type="number" name="user_id" value="{{Auth::user()->id}}" hidden>
            </div>

            <div class="mb-4 w-[60vw]">
                <label for="topic_id">Topic</label><br>
                <input class="p-1" id="topic_id" type="text" inputmode="numeric" pattern="[0-9]*" name="topic_id" autocomplete="off">
            </div>

            <div class="flex flex-col w-[60vw] mx-auto mb-4">
                <label for="content">Your message</label>
                <textarea name="content" id="content" cols="30" rows="5">
                    Your text...
                </textarea>
            </div>

            <div>
                <button type="submit" class="border p-3">Send</button>
            </div>
        </form>


    </div>


</x-app-layout>
