@php
    $pillars = [
        [
            'tag'   => 'Our Vision',
            'title' => 'To Become Bangladesh\'s Most Trusted Design Studio',
            'desc'  => 'Establishing Foundation Architects & Interior as the country\'s most valued brand in interior design — known for integrity, innovation, and spaces that elevate everyday life.',
            'icon'  => 'M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
            'accent'=> 'from-brand-500 to-brand-700',
        ],
        [
            'tag'   => 'Our Mission',
            'title' => 'Designing Functional Spaces That Inspire',
            'desc'  => 'To transform every space into a calm, functional, and beautiful environment — delivered on time, within budget, and crafted with honest materials and skilled hands.',
            'icon'  => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z',
            'accent'=> 'from-brand-600 to-brand-800',
        ],
    ];
@endphp

<section class="bg-brand-50 py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
            <p class="font-script text-3xl leading-none text-brand-600 sm:text-4xl">What Drives Us</p>
            <h2 class="mt-3 font-display text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl">
                Our Vision &amp; Mission
            </h2>
            <p class="mt-4 text-stone-500">
                The principles that shape every line we draw and every space we build.
            </p>
        </div>

        {{-- Two pillars --}}
        <div class="mt-14 grid gap-6 md:grid-cols-2 lg:gap-8">
            @foreach ($pillars as $p)
                <div class="group relative overflow-hidden rounded-3xl border border-brand-100 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-brand-500/10 sm:p-10">
                    {{-- Ghost icon --}}
                    <svg class="pointer-events-none absolute -right-6 -top-6 h-36 w-36 text-brand-50 transition-colors duration-300 group-hover:text-brand-100" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $p['icon'] }}"/>
                    </svg>

                    <div class="relative">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br {{ $p['accent'] }} text-white shadow-lg shadow-brand-500/30">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $p['icon'] }}"/>
                            </svg>
                        </div>

                        <p class="mt-6 text-xs font-bold uppercase tracking-[0.2em] text-brand-600">{{ $p['tag'] }}</p>
                        <h3 class="mt-2 font-display text-2xl font-bold leading-snug text-brand-900">{{ $p['title'] }}</h3>
                        <p class="mt-4 leading-relaxed text-stone-600">{{ $p['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
