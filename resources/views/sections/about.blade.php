@php
    $features = [
        [
            'title' => 'Custom Design',
            'desc'  => 'Tailored to your taste, space & budget.',
            'icon'  => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z',
        ],
        [
            'title' => 'On-Time Handover',
            'desc'  => 'Projects delivered right on schedule.',
            'icon'  => 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
        [
            'title' => 'Quality Guaranteed',
            'desc'  => 'Premium materials & expert craftsmanship.',
            'icon'  => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.249-8.25-3.286z',
        ],
        [
            'title' => 'Fair & Honest Price',
            'desc'  => 'Premium quality at transparent prices.',
            'icon'  => 'M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z',
        ],
    ];
@endphp

<section id="about" class="bg-white py-20 sm:py-28">
    <div class="mx-auto grid max-w-7xl items-center gap-14 px-4 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8">

        {{-- ===== Left: interior images + floating badges ===== --}}
        <div class="relative">
            {{-- Main image --}}
            <div class="relative overflow-hidden rounded-3xl shadow-2xl shadow-brand-900/10 ring-1 ring-black/5">
                <img src="{{ asset('images/portfolio/project-2.jpg') }}" alt="Interior design project"
                     class="h-[26rem] w-full object-cover sm:h-[32rem]">

                {{-- Top-right floating badge --}}
                <div class="absolute right-4 top-4 flex items-center gap-2 rounded-full bg-white/95 px-4 py-2 shadow-lg backdrop-blur">
                    <svg class="h-5 w-5 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-semibold text-brand-900">100% Satisfaction</span>
                </div>
            </div>

            {{-- Secondary overlapping image (bottom-left) --}}
            <div class="absolute -bottom-8 left-5 hidden w-40 overflow-hidden rounded-2xl border-4 border-white shadow-xl sm:left-8 md:block">
                <img src="{{ asset('images/portfolio/project-1.jpg') }}" alt="Interior detail"
                     class="aspect-square w-full object-cover">
            </div>

            {{-- Stat badge (bottom-right) --}}
            <div class="absolute -bottom-6 right-5 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 px-6 py-4 text-center text-white shadow-xl sm:right-8">
                <p class="text-2xl font-bold leading-none">10+</p>
                <p class="mt-1 text-[11px] font-medium text-white/90">Years Experience</p>
            </div>
        </div>

        {{-- ===== Right: about text ===== --}}
        <div>
            <span class="inline-flex items-center gap-2 rounded-full bg-brand-100 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-brand-700">
                <span class="h-1.5 w-1.5 rounded-full bg-brand-500"></span>
                About Us
            </span>

            <h2 class="mt-5 font-display text-4xl font-bold leading-tight tracking-tight text-brand-900 sm:text-5xl">
                Elegant, Functional &amp; Timeless Interiors
            </h2>

            <p class="mt-5 text-base leading-relaxed text-stone-600">
                Foundation Architects &amp; Interior is a trusted name in the interior sector of Bangladesh — working
                with faith and honesty. From concept to handover, we design and build beautiful, functional spaces for
                homes, offices, and commercial projects — tailored to your taste, lifestyle, and budget.
            </p>

            {{-- Feature cards (2x2) --}}
            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach ($features as $feature)
                    <div class="rounded-xl border border-brand-100 bg-white p-4 shadow-sm transition duration-300 hover:border-brand-300 hover:shadow-md hover:shadow-brand-500/5">
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-brand-50 text-brand-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-brand-900">{{ $feature['title'] }}</h3>
                                <p class="mt-1 text-xs leading-relaxed text-stone-500">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Buttons --}}
            <div class="mt-8 flex flex-wrap items-center gap-4">
                <a href="#services"
                   class="group inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-brand-500 to-brand-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:from-brand-500 hover:to-brand-700">
                    Learn More
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="#contact"
                   class="inline-flex items-center gap-2 rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-brand-700 ring-1 ring-brand-200 transition hover:bg-brand-50 hover:ring-brand-300">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>
