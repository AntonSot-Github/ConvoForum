@if (session('success'))
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-200 rounded-lg bg-green-50 shadow-sm w-50" role="alert">

        <span class="sr-only">Success</span>
        <div>
            <span class="font-semibold">&#9989; Success</span> {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-200 rounded-lg bg-red-50 shadow-sm" role="alert">

        <span class="sr-only">Error</span>
        <div>
            <span class="font-semibold">&#10060; Error</span> {{ session('error') }}
        </div>
    </div>
@endif
