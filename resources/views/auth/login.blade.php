@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h2>

        <form action="/login" method="POST" class="flex flex-col space-y-5">
            @csrf

            <div class="flex flex-col items-start">
                <label for="name" class="mb-1 ml-1 text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-input"
                    placeholder="Username" required autocomplete="off">
            </div>


            <div class="flex flex-col items-start">
                <label for="password" class="mb-1 ml-1 text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" minlength="8" class="form-input"
                    placeholder="********" required autocomplete="off">
            </div>


            <div class="pt-4">
                <button
                    class="w-full relative inline-flex items-center justify-center px-8 py-3 font-semibold text-white transition-all duration-200 bg-indigo-600 rounded-lg group hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 shadow-lg shadow-indigo-200/50">
                    <span>Login</span>
                    <svg class="w-5 h-5 ml-2 transition-all duration-200 transform group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

@endsection
