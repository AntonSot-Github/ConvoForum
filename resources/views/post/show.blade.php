<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            <a href="{{ route('home.index') }}">{{ __('Convoforum') }}</a>
        </h2>
    </x-slot>

    @section('content')

        <div class="w-1/2 mx-auto ">

            {{-- Showing errors when a form is not accepted --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form for post --}}
            <form action="{{ route('post.update', [$post]) }}" method="POST"
                class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-sm transition-shadow overflow-hidden"
                enctype="multipart/form-data">
                <h2 class="text-center bg-slate-50 border-b border-slate-100 px-6 py-4 mb-3">Edit post</h2>
                @csrf
                @method('PUT')

                <div>
                    {{-- Conversation topic --}}
                    <div class="mb-4 px-4">
                        <fieldset>
                            <legend class="mb-2"><i>Select topic for your post or create a new one</i></legend>


                            {{-- CREATE NEW TOPIC --}}
                            <div class="mb-3">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="topic_mode" value="new">
                                    Create new topic
                                </label>

                                <input type="text" name="new_topic_title" id="new_topic_input"
                                    class="mt-2 w-full border rounded p-2 opacity-30" placeholder="New topic title..."
                                    disabled>
                            </div>


                            {{-- SELECT EXISTING --}}
                            <div>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="topic_mode" value="existing" checked>
                                    Select existing topic
                                </label>


                                <select name="existing_topic_id" id="existing_topic_select"
                                    class="mt-2 w-full border rounded p-2 ">
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}"
                                            {{ old('existing_topic_id', $post->topic_id) == $topic->id ? 'selected' : '' }}>
                                            {{ $topic->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>

                    {{-- Post picture --}}
                    @if ($post->picture)
                        <div class="mb-3 p-2">
                            <p class="text-sm text-gray-500">Current image:</p>
                            <img src="{{ asset('storage/' . $post->picture) }}" class="max-w-xs mx-auto">
                        </div>
                    @endif

                    <div class="flex flex-col mx-auto mb-4 px-4">
                        <label for="userPicture"><i>Replace image (optional)</i></label>
                        <input type="file" name="userPicture">
                    </div>

                    {{-- Post text --}}
                    <div class="flex flex-col mx-auto mb-4 px-4">
                        <label for="content"><i>Edit your message</i></label>
                        <textarea name="content" id="content" cols="30" rows="5" placeholder="Your text...">{{ $post->content }}</textarea>
                    </div>

                    <div class="w-full flex justify-center mb-5">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-full font-medium hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-200">
                            Public
                        </button>
                    </div>
                </div>

            </form>


        </div>

        {{-- JS for topic-selecting --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const radios = document.querySelectorAll('input[name="topic_mode"]');
                const newInput = document.getElementById('new_topic_input');
                const selectInput = document.getElementById('existing_topic_select');

                radios.forEach(radio => {
                    radio.addEventListener('change', function() {

                        if (this.value === 'new') {
                            newInput.disabled = false;
                            selectInput.disabled = true;
                            newInput.style.opacity = '1';
                            selectInput.style.opacity = '0.3';
                        } else {
                            newInput.disabled = true;
                            selectInput.disabled = false;
                            newInput.style.opacity = '0.3';
                            selectInput.style.opacity = '1';
                        }

                    });
                });

            });
        </script>


    @endsection


    <x-slot name="footer"></x-slot>

</x-app-layout>
