@props([
    'name',
    'label' => null,
    'options' => [],
    'value' => null,
    'required' => false,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-brand-900">
            {{ $label }}@if ($required)<span class="text-rose-500"> *</span>@endif
        </label>
    @endif
    <select name="{{ $name }}" id="{{ $name }}" @if ($required) required @endif
        {{ $attributes->merge(['class' => 'mt-2 block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30']) }}>
        @foreach ($options as $optValue => $optLabel)
            @php $real = is_int($optValue) ? $optLabel : $optValue; @endphp
            <option value="{{ $real }}" @selected((string) old($name, $value) === (string) $real)>{{ $optLabel }}</option>
        @endforeach
    </select>
    @error($name)<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
</div>
