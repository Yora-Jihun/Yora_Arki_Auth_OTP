@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'autocomplete' => null,
    'model' => null,
])

@php
    $isPassword = $type === 'password';
    $inputId = $name;
@endphp

<div class="space-y-2" @if($isPassword) x-data="{ eyeOpen: false }" @endif>
    <label for="{{ $inputId }}" class="block text-xs font-medium text-gray-500 mb-1.5">
        {{ $label }}
    </label>

    <div class="relative">
        <input
            @if($isPassword)
                :type="eyeOpen ? 'text' : 'password'"
            @else
                type="{{ $type }}"
            @endif
            id="{{ $inputId }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            @if($autocomplete)
                autocomplete="{{ $autocomplete }}"
            @endif
            @if($model)
                wire:model="{{ $model }}"
            @endif
            {{ $attributes->except(['type', 'wire:model']) }}
            class="w-full bg-gray-50 px-3 py-2 text-sm text-gray-900 border border-gray-100 focus:outline-none focus:border-blue-300 focus:bg-white transition"
        >

        @if($isPassword)
            <button
                type="button"
                @click="eyeOpen = !eyeOpen"
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition"
                aria-label="Toggle password visibility"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" :d="eyeOpen ? 'M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z' : 'M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.223L3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88';"/>
                </svg>
            </button>
        @endif
    </div>

    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>