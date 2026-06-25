@php
    $founder = $settings->get('about.founder', []);
    $founder = is_array($founder) ? $founder : [];
    $founder += [
        'name'  => 'Md. Ashraful Haque',
        'title' => 'Founder & Principal Architect',
        'photo' => 'images/team/founder.jpg',
        'bio1'  => 'A visionary architect with a passion for honest, people-first design, our founder started Foundation Architects & Interior in 2016 to raise the standard of interior design in Bangladesh.',
        'bio2'  => 'With a background in architecture and over a decade of hands-on experience, he leads the studio with a simple promise — every space we deliver should be beautiful, functional, and built with integrity.',
        'quote' => 'Great design isn\'t about luxury — it\'s about creating spaces where life feels effortless.',
        'stats' => [
            ['v' => '10+', 'l' => 'Years Leading'],
            ['v' => '500+', 'l' => 'Projects Guided'],
            ['v' => 'B.Arch', 'l' => 'Qualified'],
        ],
    ];
    if (empty($founder['stats']) || ! is_array($founder['stats'])) {
        $founder['stats'] = [];
    }
    $hasPhoto = ! empty($founder['photo']) && file_exists(public_path($founder['photo']));
    $initials = collect(explode(' ', $founder['name']))->filter(fn ($w) => ctype_alpha($w[0] ?? ''))->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->implode('');
@endphp

<section class="bg-brand-50 py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
            <p class="section-eyebrow text-brand-600">Leadership</p>
            <h2 class="mt-3 font-display text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl">
                Meet Our Founder
            </h2>
            <p class="mt-4 text-stone-500">
                The vision and the values behind everything we create.
            </p>
        </div>

        <div class="mt-16 grid items-center gap-12 lg:grid-cols-5 lg:gap-16">

            {{-- ===== Portrait ===== --}}
            <div class="lg:col-span-2">
                <div class="relative mx-auto max-w-sm">
                    <div class="relative aspect-[4/5] overflow-hidden rounded-3xl shadow-2xl shadow-brand-900/20 ring-1 ring-black/5">
                        @if ($hasPhoto)
                            <img src="{{ asset($founder['photo']) }}" alt="{{ $founder['name'] }}" class="h-full w-full object-cover">
                        @else
                            {{-- Designed placeholder (until a real photo is added) --}}
                            <div class="flex h-full w-full flex-col items-center justify-center bg-gradient-to-br from-brand-600 via-brand-700 to-brand-900 text-white">
                                <span class="font-display text-6xl font-bold tracking-wide text-white/90">{{ $initials }}</span>
                                <svg class="mt-4 h-12 w-12 text-white/40" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>
                            </div>
                        @endif

                        {{-- Name plate --}}
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-6 pt-12">
                            <p class="font-display text-xl font-semibold text-white">{{ $founder['name'] }}</p>
                            <p class="text-sm text-brand-200">{{ $founder['title'] }}</p>
                        </div>
                    </div>

                    {{-- Floating monogram --}}
                    <div class="absolute -right-4 -top-4 hidden h-16 w-16 items-center justify-center rounded-2xl bg-white p-2 shadow-xl ring-1 ring-black/5 sm:flex">
                        <img src="{{ asset('images/logo.svg') }}" alt="" class="h-full w-full rounded-xl">
                    </div>
                </div>
            </div>

            {{-- ===== Bio ===== --}}
            <div class="lg:col-span-3">
                <span class="inline-flex items-center gap-2 rounded-full bg-brand-100 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-brand-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-brand-500"></span>
                    Founder &amp; Principal Architect
                </span>

                <h3 class="mt-5 font-display text-3xl font-bold leading-tight text-brand-900 sm:text-4xl">
                    {{ $founder['name'] }}
                </h3>

                <p class="mt-5 leading-relaxed text-stone-600">{{ $founder['bio1'] }}</p>
                <p class="mt-4 leading-relaxed text-stone-600">{{ $founder['bio2'] }}</p>

                {{-- Quote --}}
                <blockquote class="mt-6 rounded-2xl border-l-4 border-brand-500 bg-white p-5 shadow-sm">
                    <p class="font-display text-lg italic text-brand-800">&ldquo;{{ $founder['quote'] }}&rdquo;</p>
                </blockquote>

                {{-- Mini stats --}}
                <div class="mt-8 grid grid-cols-3 gap-4">
                    @foreach ($founder['stats'] as $s)
                        <div class="rounded-xl border border-brand-100 bg-white p-4 text-center shadow-sm">
                            <p class="font-display text-2xl font-bold text-brand-700">{{ $s['v'] }}</p>
                            <p class="mt-1 text-xs font-medium text-stone-500">{{ $s['l'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
