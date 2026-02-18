@extends('layouts.app')

@section('title', 'Registration')


@section('content')

<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Registration</h2>

    <form action="/registr" method="POST" class="flex flex-col space-y-5" enctype="multipart/form-data">
        @csrf
        
        <div class="flex flex-col items-start">
            <label for="name" class="mb-1 ml-1 text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                   class="form-input"
                   placeholder="Username" required autocomplete="off">
        </div>

        <div class="flex flex-col items-start">
            <label for="email" class="mb-1 ml-1 text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" 
                   class="form-input"
                   placeholder="user@gmail.com" required autocomplete="off">
        </div>

        <div class="flex flex-col items-start">
            <label for="password" class="mb-1 ml-1 text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" minlength="8" 
                   class="form-input"
                   placeholder="********" required autocomplete="off">
        </div>

        {{-- Avatar img-file --}}
        <div class="flex flex-col items-start">
            <label for="avatar" class="mb-1 ml-1 text-sm font-medium text-gray-700">Avatar</label>
            <input type="file" name="avatar" id="avatar"
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
        </div>

        <div class="pt-4">
            <button class="w-full relative inline-flex items-center justify-center px-8 py-3 font-semibold text-white transition-all duration-200 bg-indigo-600 rounded-lg group hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 shadow-lg shadow-indigo-200/50">
                <span>Registr</span>
                <svg class="w-5 h-5 ml-2 transition-all duration-200 transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>
        </div>
    </form>
</div>
@endsection