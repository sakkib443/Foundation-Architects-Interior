@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'required' => false,
    'hint' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-brand-900">
            {{ $label }}@if ($required)<span class="text-rose-500"> *</span>@endif
        </label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" @if ($required) required @endif
        {{ $attributes->merge(['class' => 'mt-2 block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30']) }}>
    @if ($hint)<p class="mt-1 text-xs text-stone-400">{{ $hint }}</p>@endif
    @error($name)<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
</div>
