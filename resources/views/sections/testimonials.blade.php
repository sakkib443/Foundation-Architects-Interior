@php
    $testimonials = \App\Models\Testimonial::where('is_published', true)->orderBy('sort_order')->get();
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
                    @include('partials.testimonial-card', [
                        't'            => $t,
                        'extraClasses' => 'mr-6 w-[340px] shrink-0',
                        'ariaHidden'   => $copy === 1,
                    ])
                @endforeach
            @endfor
        </div>
    </div>
</section>
