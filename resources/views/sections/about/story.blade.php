@php
    $story = $settings->get('about.story', []);
    $story = is_array($story) ? $story : [];

    $headline   = $story['headline'] ?? 'Building Spaces, Crafting Lifestyles';
    $paragraphs = (! empty($story['paragraphs']) && is_array($story['paragraphs'])) ? $story['paragraphs'] : [
        'Foundation Architects & Interior began in 2016 with a simple belief — that good design should be honest, functional, and made for the people who live in it. What started as a small team of dreamers has grown into a full-service architecture and interior studio trusted across Bangladesh.',
        'From the first sketch to the final handover, we manage every detail in-house — architecture, interior styling, 3D visualization, and on-site execution. The result is a calm, seamless experience and spaces that stand the test of time.',
    ];
    $highlights = (! empty($story['highlights']) && is_array($story['highlights'])) ? $story['highlights'] : [
        'Concept-to-handover, end-to-end delivery',
        'Faith, honesty & transparent pricing',
        'In-house architects, designers & 3D artists',
    ];
    $year  = $story['year'] ?? '10+';
    $badge = $story['badge'] ?? "Years of\nDesign Excellence";
    $images = (! empty($story['images']) && is_array($story['images'])) ? array_values($story['images']) : [
        'images/portfolio/project-1.jpg',
        'images/portfolio/project-3.jpg',
        'images/portfolio/project-4.jpg',
        'images/portfolio/project-2.jpg',
    ];
@endphp

<section class="bg-white py-20 sm:py-28">
    <div class="mx-auto grid max-w-7xl items-center gap-14 px-4 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8">

        {{-- ===== Left: image collage ===== --}}
        <div class="relative">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4 pt-8">
                    <div class="overflow-hidden rounded-2xl shadow-lg ring-1 ring-black/5">
                        <img src="{{ asset($images[0] ?? 'images/portfolio/project-1.jpg') }}" alt="Interior project" loading="lazy"
                             class="aspect-[3/4] w-full object-cover transition duration-700 hover:scale-105">
                    </div>
                    <div class="overflow-hidden rounded-2xl shadow-lg ring-1 ring-black/5">
                        <img src="{{ asset($images[1] ?? 'images/portfolio/project-3.jpg') }}" alt="Interior project" loading="lazy"
                             class="aspect-square w-full object-cover transition duration-700 hover:scale-105">
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="overflow-hidden rounded-2xl shadow-lg ring-1 ring-black/5">
                        <img src="{{ asset($images[2] ?? 'images/portfolio/project-4.jpg') }}" alt="Interior project" loading="lazy"
                             class="aspect-square w-full object-cover transition duration-700 hover:scale-105">
                    </div>
                    <div class="overflow-hidden rounded-2xl shadow-lg ring-1 ring-black/5">
                        <img src="{{ asset($images[3] ?? 'images/portfolio/project-2.jpg') }}" alt="Interior project" loading="lazy"
                             class="aspect-[3/4] w-full object-cover transition duration-700 hover:scale-105">
                    </div>
                </div>
            </div>

            {{-- Floating experience badge --}}
            <div class="absolute -bottom-6 left-1/2 flex -translate-x-1/2 items-center gap-3 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 px-6 py-4 text-white shadow-xl">
                <span class="font-display text-3xl font-bold leading-none">{{ $year }}</span>
                <span class="text-xs font-medium leading-tight text-white/90">{!! nl2br(e($badge)) !!}</span>
            </div>
        </div>

        {{-- ===== Right: story ===== --}}
        <div>
            <span class="inline-flex items-center gap-2 rounded-full bg-brand-100 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-brand-700">
                <span class="h-1.5 w-1.5 rounded-full bg-brand-500"></span>
                Our Story
            </span>

            <h2 class="mt-5 font-display text-4xl font-bold leading-tight tracking-tight text-brand-900 sm:text-[2.75rem]">
                {{ $headline }}
            </h2>

            @foreach ($paragraphs as $i => $paragraph)
                <p class="{{ $i === 0 ? 'mt-5' : 'mt-4' }} leading-relaxed text-stone-600">
                    {{ $paragraph }}
                </p>
            @endforeach

            {{-- Highlights --}}
            <ul class="mt-7 space-y-3">
                @foreach ($highlights as $point)
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-100 text-brand-600">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </span>
                        <span class="text-stone-700">{{ $point }}</span>
                    </li>
                @endforeach
            </ul>

            {{-- Founder signature line --}}
            <div class="mt-8 flex items-center gap-4 border-t border-stone-100 pt-6">
                <img src="{{ asset('images/logo.svg') }}" alt="" class="h-12 w-12 rounded-full ring-1 ring-brand-100">
                <div>
                    <p class="font-script text-2xl leading-none text-brand-700">Foundation Architects</p>
                    <p class="mt-1 text-xs font-medium uppercase tracking-wider text-stone-500">Design for Life — since 2016</p>
                </div>
            </div>
        </div>
    </div>
</section>
