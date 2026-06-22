@php
    $testimonials = [
        [
            'name'   => 'Rafiqul Islam',
            'role'   => 'Homeowner, Dhanmondi',
            'rating' => 5,
            'text'   => 'From the first consultation to the final handover, the team was professional and detail-oriented. Our apartment feels brand new — exactly the modern, cozy look we wanted.',
        ],
        [
            'name'   => 'Sumaiya Akter',
            'role'   => 'Café Owner, Gulshan',
            'rating' => 5,
            'text'   => 'They transformed our café into a space customers love to sit in for hours. Beautiful design, delivered right on time and well within our budget.',
        ],
        [
            'name'   => 'Tanvir Hasan',
            'role'   => 'Office Manager, Banani',
            'rating' => 5,
            'text'   => 'Outstanding workmanship and honest pricing. Our office now looks premium and functional. Highly recommend Foundation Architects & Interior to anyone.',
        ],
        [
            'name'   => 'Nusrat Jahan',
            'role'   => 'Apartment Owner, Bashundhara',
            'rating' => 5,
            'text'   => 'I loved how they listened to every little preference. The 3D design matched the final result perfectly — a truly stress-free experience from start to finish.',
        ],
        [
            'name'   => 'Mahmudul Karim',
            'role'   => 'Restaurant Owner, Uttara',
            'rating' => 5,
            'text'   => 'Our restaurant\'s new interior brings in more customers than ever. Elegant, durable, and completed exactly on schedule. Worth every taka.',
        ],
    ];

    $quoteIcon = 'M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849H0v-10h9.983zm14.017 0v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983z';
    $starIcon  = 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z';
@endphp

<section id="testimonials" class="bg-white py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header (centered) --}}
        <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
            <p class="font-script text-3xl leading-none text-brand-600 sm:text-4xl">Testimonials</p>
            <h2 class="mt-3 font-display text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl">
                What Our Clients Say
            </h2>
            <p class="mt-4 text-stone-500">
                Real words from homeowners and businesses we've designed for across Bangladesh.
            </p>
        </div>
    </div>

    {{-- Auto-scrolling carousel (pauses on hover) --}}
    <div class="testimonial-marquee group relative mt-14 overflow-hidden">

        {{-- Edge fades --}}
        <div class="pointer-events-none absolute inset-y-0 left-0 z-10 w-16 bg-gradient-to-r from-white to-transparent sm:w-32"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 z-10 w-16 bg-gradient-to-l from-white to-transparent sm:w-32"></div>

        <div class="testimonial-track flex">
            {{-- Rendered twice for a seamless infinite loop --}}
            @for ($copy = 0; $copy < 2; $copy++)
                @foreach ($testimonials as $t)
                    @php
                        $initials = implode('', array_map(fn ($w) => mb_substr($w, 0, 1), array_slice(explode(' ', $t['name']), 0, 2)));
                    @endphp
                    <figure @if ($copy === 1) aria-hidden="true" @endif
                            class="mr-6 flex w-[340px] shrink-0 flex-col rounded-2xl border border-stone-100 bg-white p-6 shadow-lg shadow-stone-900/5 ring-1 ring-stone-900/5">

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
                @endforeach
            @endfor
        </div>
    </div>
</section>
