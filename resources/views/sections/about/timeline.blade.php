@php
    $milestones = $settings->get('about.timeline', []);
    $milestones = (is_array($milestones) && ! empty($milestones)) ? $milestones : [
        ['year' => '2016', 'title' => 'The Foundation', 'description' => 'Founded in Dhaka with a clear purpose — to deliver honest, modern interior design and bring premium quality within reach for Bangladeshi homes.'],
        ['year' => '2018', 'title' => 'Portfolio Expansion', 'description' => 'Grew beyond homes into commercial and corporate spaces — cafés, offices, and retail — successfully delivering on time and on budget.'],
        ['year' => '2020', 'title' => '3D Visualization & R&D', 'description' => 'Adopted advanced 3D visualization and a dedicated R&D approach, letting clients walk through their space before a single brick is laid.'],
        ['year' => '2022', 'title' => 'Organizational Growth', 'description' => 'Structured in-house teams for architecture, interior, 3D, and project operations — scaling delivery without ever compromising on quality.'],
        ['year' => '2024', 'title' => '500+ Clients Milestone', 'description' => 'Celebrated serving over 500 satisfied clients, driven by transparent pricing and a genuinely friendly, design-first experience.'],
        ['year' => '2026', 'title' => 'Looking Forward', 'description' => 'Today we keep pushing the craft — sustainable materials, smarter spaces, and a vision to become the most trusted interior brand in the country.'],
    ];
@endphp

<section class="bg-white py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
            <p class="section-eyebrow text-brand-600">Our Journey</p>
            <h2 class="mt-3 font-display text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl">
                A Decade of Growth
            </h2>
            <p class="mt-4 text-stone-500">
                Milestones that mark our journey from a small studio to a name people trust.
            </p>
        </div>

        {{-- Timeline --}}
        <div class="relative mx-auto mt-16 max-w-3xl">
            {{-- Vertical line --}}
            <span class="absolute left-5 top-1 h-full w-0.5 -translate-x-1/2 bg-gradient-to-b from-brand-300 via-brand-200 to-transparent sm:left-1/2"></span>

            <div class="space-y-10 sm:space-y-14">
                @foreach ($milestones as $i => $m)
                    <div class="relative flex {{ $i % 2 === 0 ? 'sm:flex-row' : 'sm:flex-row-reverse' }}">
                        {{-- Node --}}
                        <span class="absolute left-5 top-1.5 z-10 -translate-x-1/2 sm:left-1/2">
                            <span class="flex h-4 w-4 items-center justify-center rounded-full border-2 border-white bg-brand-500 shadow-md shadow-brand-500/40 ring-4 ring-brand-100"></span>
                        </span>

                        {{-- Card --}}
                        <div class="ml-12 sm:ml-0 sm:w-1/2 sm:px-10 {{ $i % 2 === 0 ? 'sm:text-right' : 'sm:text-left' }}">
                            <div class="group rounded-2xl border border-brand-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-brand-300 hover:shadow-lg hover:shadow-brand-500/10 sm:p-6">
                                <span class="inline-flex rounded-full bg-brand-50 px-3 py-1 font-display text-sm font-bold text-brand-700">
                                    {{ $m['year'] ?? '' }}
                                </span>
                                <h3 class="mt-3 font-display text-lg font-semibold text-brand-900">{{ $m['title'] ?? '' }}</h3>
                                <p class="mt-2 text-sm leading-relaxed text-stone-500">{{ $m['description'] ?? '' }}</p>
                            </div>
                        </div>

                        {{-- Spacer half (desktop) --}}
                        <div class="hidden sm:block sm:w-1/2"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
