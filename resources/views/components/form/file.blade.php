@props([
    'name',
    'label' => null,
    'current' => null,
    'hint' => 'JPG/PNG/WebP. Leave empty to keep the current image.',
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-brand-900">{{ $label }}</label>
    @endif
    <div class="mt-2 flex items-center gap-4">
        @if ($current)
            <img src="{{ asset($current) }}" alt="" class="h-20 w-28 rounded-lg object-cover ring-1 ring-stone-200">
        @endif
        <img id="{{ $name }}-preview" alt="" class="hidden h-20 w-28 rounded-lg object-cover ring-1 ring-brand-300">
        <input type="file" name="{{ $name }}" id="{{ $name }}" accept="image/*" data-preview="#{{ $name }}-preview"
            {{ $attributes->merge(['class' => 'block w-full text-sm text-stone-500 file:mr-4 file:rounded-full file:border-0 file:bg-brand-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-700 hover:file:bg-brand-100']) }}>
    </div>
    @if ($hint)<p class="mt-1 text-xs text-stone-400">{{ $hint }}</p>@endif
    @error($name)<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
</div>
