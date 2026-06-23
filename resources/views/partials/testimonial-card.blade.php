{{--
    Single testimonial card.
    Expects: $t (name, role, rating, text)
    Optional: $extraClasses (string appended to figure classes), $ariaHidden (bool)
--}}
@php
    $initials = implode('', array_map(fn ($w) => mb_substr($w, 0, 1), array_slice(explode(' ', $t['name']), 0, 2)));
    $quoteIcon = 'M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849H0v-10h9.983zm14.017 0v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983z';
    $starIcon  = 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z';
@endphp

<figure @if (!empty($ariaHidden)) aria-hidden="true" @endif
        class="flex flex-col rounded-2xl border border-stone-100 bg-white p-6 shadow-lg shadow-stone-900/5 ring-1 ring-stone-900/5 {{ $extraClasses ?? '' }}">

    {{-- Quote mark + stars --}}
    <div class="flex items-start justify-between">
        <svg class="h-9 w-9 text-brand-100" fill="currentColor" viewBox="0 0 24 24">
            <path d="{{ $quoteIcon }}"/>
        </svg>
        <div class="flex items-center gap-0.5">
            @for ($s = 0; $s < 5; $s++)
                <svg class="h-4 w-4 {{ $s < $t['rating'] ? 'text-amber-400' : 'text-stone-200' }}" fill="currentColor" viewBox="0 0 24 24">
                    <path d="{{ $starIcon }}"/>
                </svg>
            @endfor
        </div>
    </div>

    {{-- Quote --}}
    <blockquote class="mt-4 flex-1 leading-relaxed text-stone-600">
        "{{ $t['text'] }}"
    </blockquote>

    {{-- Author --}}
    <figcaption class="mt-6 flex items-center gap-3 border-t border-stone-100 pt-5">
        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-brand-400 to-brand-600 text-sm font-bold text-white">
            {{ $initials }}
        </div>
        <div>
            <p class="font-semibold text-brand-900">{{ $t['name'] }}</p>
            <p class="text-xs text-stone-500">{{ $t['role'] }}</p>
        </div>
    </figcaption>
</figure>
