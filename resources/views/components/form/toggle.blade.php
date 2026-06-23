@props([
    'name',
    'label',
    'checked' => true,
])

{{-- Hidden 0 ensures an unchecked box still posts a value; checked posts 1 (last wins). --}}
<input type="hidden" name="{{ $name }}" value="0">
<label class="inline-flex cursor-pointer items-center gap-3">
    <span class="relative inline-block h-6 w-11 shrink-0">
        <input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $checked)) class="peer sr-only">
        <span class="absolute inset-0 rounded-full bg-stone-300 transition peer-checked:bg-brand-600"></span>
        <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow transition peer-checked:translate-x-5"></span>
    </span>
    <span class="text-sm font-medium text-brand-900">{{ $label }}</span>
</label>
