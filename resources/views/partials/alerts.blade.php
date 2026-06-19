@props(['type' => 'info', 'message' => null, 'class' => ''])

@php
$styles = [
    'success' => [
        'border' => 'border border-green-300/60',
        'background' => 'bg-green-50/70 backdrop-blur-md',
        'text' => 'text-green-700',
        'iconBackground' => 'bg-green-100/80',
        'iconText' => 'text-green-600',
        'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" /></svg>',
    ],
    'warning' => [
        'border' => 'border border-yellow-300/60',
        'background' => 'bg-yellow-50/70 backdrop-blur-md',
        'text' => 'text-yellow-700',
        'iconBackground' => 'bg-yellow-100/80',
        'iconText' => 'text-yellow-600',
        'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-9.75 9 15.75H3L12 3Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5v.75" /></svg>',
    ],
    'error' => [
        'border' => 'border border-red-300/60',
        'background' => 'bg-red-50/70 backdrop-blur-md',
        'text' => 'text-red-700',
        'iconBackground' => 'bg-red-100/80',
        'iconText' => 'text-red-600',
        'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>',
    ],
    'info' => [
        'border' => 'border border-blue-300/60',
        'background' => 'bg-blue-50/70 backdrop-blur-md',
        'text' => 'text-blue-700',
        'iconBackground' => 'bg-blue-100/80',
        'iconText' => 'text-blue-600',
        'icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.83a.75.75 0 0 0 .728.938h.75a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.75a.75.75 0 0 0-.75.75v.75ZM12 2.25a9.75 9.75 0 1 0 0 19.5 9.75 9.75 0 0 0 0-19.5Z" /></svg>',
    ],
];

$style = $styles[$type] ?? $styles['info'];
@endphp

@if ($message)
        <div role="{{ $type === 'error' ? 'alert' : 'status' }}" class="flex gap-3 {{ $style['border'] }} {{ $style['background'] }} {{ $style['text'] }} px-4 py-3 text-sm {{ $class }}">
        <span class="{{ $style['iconBackground'] }} {{ $style['iconText'] }} mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full">
            {!! $style['icon'] !!}
        </span>
        <div>{{ $message }}</div>
    </div>
@endif
