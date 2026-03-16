
@props(['color' => 'indigo']) {{-- Default color for button--}}

@php
// Available colors
$colors = [
    'indigo' => 'bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 shadow-indigo-200',
    'red'    => 'bg-red-600 hover:bg-red-700 focus:ring-red-500 shadow-red-200',
    'green'  => 'bg-green-600 hover:bg-green-700 focus:ring-green-500 shadow-green-200',
    'slate'  => 'bg-slate-600 hover:bg-slate-700 focus:ring-slate-500 shadow-slate-200',
];

$colorClasses = $colors[$color] ?? $colors['indigo'];
@endphp

<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => "inline-flex items-center justify-center px-6 py-2 text-sm font-semibold text-white transition-all duration-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 shadow-lg " . $colorClasses
]) }}>
    {{ $slot }}
</button>
