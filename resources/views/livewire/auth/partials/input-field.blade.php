@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'autocomplete' => null,
])

<div class="space-y-2">
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">
        {{ $label }}
    </label>

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value ?? '') }}"
        placeholder="{{ $placeholder }}"
        @if($autocomplete)
            autocomplete="{{ $autocomplete }}"
        @endif
        {{ $attributes }}
        class="{{ $attributes->get('class', 'block w-full border border-gray-200 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition duration-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10') }}"
    >

    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
