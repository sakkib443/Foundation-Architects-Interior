@php
    $projects = [
        [
            'title'    => 'Modern Minimalist Apartment',
            'category' => 'Residential',
            'image'    => 'images/portfolio/project-1.jpg',
        ],
        [
            'title'    => 'Contemporary Luxury Residence @ Dhaka',
            'category' => 'Residential',
            'image'    => 'images/portfolio/project-2.jpg',
        ],
        [
            'title'    => 'Modern Biophilic Corporate Headquarters @ Uttara, Dhaka',
            'category' => 'Office/Corporate',
            'image'    => 'images/portfolio/project-3.jpg',
        ],
        [
            'title'    => 'Bold Contemporary Workspace @ Naya Paltan, Dhaka',
            'category' => 'Office/Corporate',
            'image'    => 'images/portfolio/project-4.jpg',
        ],
    ];
@endphp

<section id="projects" class="bg-white py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header (centered, hero-style fonts) --}}
        <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
            <p class="font-script text-3xl leading-none text-brand-600 sm:text-4xl">Our Portfolio</p>
            <h2 class="mt-3 font-display text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl">
                Explore Our Work
            </h2>
            <p class="mt-4 text-stone-500">
                A selection of residential and corporate spaces we've designed across Bangladesh.
            </p>
        </div>

        {{-- Cards --}}
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($projects as $project)
                <a href="#projects"
                   class="group relative block aspect-[3/4] overflow-hidden rounded-2xl shadow-lg shadow-stone-900/5 ring-1 ring-stone-900/5 transition duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-stone-900/20">

                    {{-- Image --}}
                    <img src="{{ asset($project['image']) }}" alt="{{ $project['title'] }}" loading="lazy"
                         class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">

                    {{-- Gradient for text legibility --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent transition-opacity duration-500 group-hover:from-black/90"></div>

                    {{-- Content --}}
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-white ring-1 ring-white/25 backdrop-blur">
                            {{ $project['category'] }}
                        </span>
                        <h3 class="mt-3 font-display text-lg font-semibold leading-snug text-white">
                            {{ $project['title'] }}
                        </h3>

                        {{-- Reveal on hover --}}
                        <span class="mt-2 flex translate-y-2 items-center gap-1.5 text-sm font-medium text-brand-200 opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                            View project
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- View all (centered) --}}
        <div class="mt-12 flex justify-center">
            <a href="#projects" class="group inline-flex items-center gap-2 rounded-full border border-brand-200 px-7 py-3 text-sm font-semibold text-brand-700 transition hover:border-brand-400 hover:bg-brand-50">
                View All Projects
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
