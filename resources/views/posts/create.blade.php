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
            <form action="{{ route('post.store') }}" method="POST"
                class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-sm transition-shadow overflow-hidden"
                enctype="multipart/form-data">
                <h2 class="text-center bg-slate-50 border-b border-slate-100 px-6 py-4 mb-3">Your post</h2>
                @csrf
                <div>

                    {{-- Conversation topic --}}
                    <div class="mb-4 px-4">
                        <fieldset>
                            <legend class="mb-2"><i>Select topic for your post or create a new one</i></legend>


                            {{-- CREATE NEW TOPIC --}}
                            <div class="mb-3">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="topic_mode" value="new" checked>
                                    Create new topic
                                </label>

                                <input type="text" name="new_topic_title" id="new_topic_input"
                                    class="mt-2 w-full border rounded p-2" placeholder="New topic title...">
                            </div>


                            {{-- SELECT EXISTING --}}
                            <div>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="topic_mode" value="existing">
                                    Select existing topic
                                </label>


                                <select name="existing_topic_id" id="existing_topic_select"
                                    class="mt-2 w-full border rounded p-2 opacity-30" disabled>
                                    <option value="" selected>Choose topic</option>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}">
                                            {{ $topic->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>

                    {{-- Post picture --}}
                    <div class="flex flex-col mx-auto mb-4 px-4">

                        <x-input-label for="userPicture_input" id="userPicture_label" :value="__('You can add a picture')" />
                        <x-text-input id="userPicture_input" accept="image/*" name="userPicture" type="file"
                            class="mt-1 block w-1/3" />

                    </div>

                    {{-- Post text --}}
                    <div class="flex flex-col mx-auto mb-4 px-4">
                        <label for="content"><i>Your message</i></label>
                        <textarea name="content" id="content" cols="30" rows="5" placeholder="Your text..."></textarea>
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

        
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                /* ---------------------- JS for topic-selecting ---------------------- */

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


                /*---------------------- Preview post-picture ----------------------*/
                let userPicture_input = document.getElementById('userPicture_input');
                let userPicture_label = document.getElementById('userPicture_label');
                userPicture_input.addEventListener('change', function(e) {

                    const file = e.target.files[0];

                    //Check if the file is selected.
                    if (!file) return;

                    //Check file type
                    if (!file.type.startsWith('image/')) {
                        alert('Please select an image');
                        userPicture_input.value = ''; // Reset selected file
                        return;
                    }

                    //Check if the image alredy has created
                    let previewPicture = document.getElementById('postPicture_preview');

                    if (!previewPicture) {
                        userPicture_label.insertAdjacentHTML("afterend",
                            "<img id='postPicture_preview' class='mx-auto mt-2 rounded-lg border w-auto h-auto shadow-sm' alt='Preview'>"
                        );
                        previewPicture = document.getElementById('postPicture_preview');
                        
                    }

                    //Change the label text after receiving the image file
                    userPicture_label.textContent = 'You can choose another picture';

                    // Setting a temporary file path in the browser
                    previewPicture.src = URL.createObjectURL(file);

                });

            });
        </script>
    @endsection



</x-app-layout>
