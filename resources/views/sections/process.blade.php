@php
    $steps = [
        [
            'title' => 'Initial Consultation',
            'time'  => '1–2 hours',
            'desc'  => 'We listen to your needs, budget, and vision to set the right foundation.',
            'icon'  => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z',
        ],
        [
            'title' => 'Concept Development',
            'time'  => '1–2 weeks',
            'desc'  => 'Mood boards, themes, and concepts crafted around your personal style.',
            'icon'  => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
        ],
        [
            'title' => 'Space Planning',
            'time'  => '2–3 weeks',
            'desc'  => 'Smart, functional layouts that make the most of every corner.',
            'icon'  => 'M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z',
        ],
        [
            'title' => 'Design Development',
            'time'  => '2–7 weeks',
            'desc'  => 'Detailed 3D designs, materials, and finishes finalized to perfection.',
            'icon'  => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
        ],
        [
            'title' => 'Implementation',
            'time'  => '6–12 weeks',
            'desc'  => 'Skilled execution and on-site management until everything is built.',
            'icon'  => 'M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.348-.422.94-.502 1.396-.27M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63',
        ],
        [
            'title' => 'Final Handover',
            'time'  => 'Project Complete',
            'desc'  => 'A final walkthrough and the keys to your beautifully transformed space.',
            'icon'  => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
    ];
@endphp

<section id="process" class="bg-brand-50 py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header (centered, hero-style fonts) --}}
        <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
            <p class="font-script text-3xl leading-none text-brand-600 sm:text-4xl">Our Expertise</p>
            <h2 class="mt-3 font-display text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl">
                Our Working Process
            </h2>
            <p class="mt-4 text-stone-500">
                We transform concepts into reality through our detailed, proven methodology.
            </p>
        </div>

        {{-- Step cards --}}
        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($steps as $i => $step)
                <div class="relative">
                    <div class="group relative h-full overflow-hidden rounded-2xl border border-brand-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-500/10">

                        {{-- Ghost step number --}}
                        <span class="pointer-events-none absolute -right-1 -top-2 select-none font-display text-6xl font-bold text-brand-100 transition-colors duration-300 group-hover:text-brand-200">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        {{-- Icon --}}
                        <div class="relative flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-brand-400 to-brand-600 text-white shadow-lg shadow-brand-500/30">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}"/>
                            </svg>
                        </div>

                        {{-- Title --}}
                        <h3 class="relative mt-4 font-display text-base font-semibold text-brand-900">
                            {{ $step['title'] }}
                        </h3>

                        {{-- Duration pill --}}
                        <span class="relative mt-2 inline-flex items-center gap-1.5 rounded-full bg-brand-50 px-2.5 py-1 text-[11px] font-semibold text-brand-700">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $step['time'] }}
                        </span>

                        {{-- Description --}}
                        <p class="relative mt-2 text-sm leading-relaxed text-stone-500">
                            {{ $step['desc'] }}
                        </p>
                    </div>

                    {{-- Connector arrow to the next step (desktop, within each row of 3) --}}
                    @if (($i + 1) % 3 !== 0)
                        <div class="absolute top-1/2 -right-6 z-10 hidden -translate-y-1/2 lg:flex">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full border border-brand-200 bg-white text-brand-500 shadow-md">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- CTAs (centered) --}}
        <div class="mt-14 flex flex-wrap items-center justify-center gap-4">
            <a href="#process"
               class="group inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-brand-400 to-brand-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:from-brand-500 hover:to-brand-700">
                View Complete Process
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="#services"
               class="group inline-flex items-center gap-2 rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-brand-700 ring-1 ring-brand-200 transition hover:bg-brand-50 hover:ring-brand-300">
                Explore All Services
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
