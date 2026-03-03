@if (session()->has('success'))
    <div 
        x-data="{ show: true }" 
        x-show="show"
        x-init="setTimeout(() => show = false, 5000)"
        class="max-w-4xl mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-300"
    >
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="max-w-4xl mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-300">
        {{ session('error') }}
    </div>
@endif