@php
    $projects = \App\Models\Project::where('is_published', true)->orderBy('sort_order')->take(8)->get();
@endphp

<section id="projects" class="bg-white py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header (centered, hero-style fonts) --}}
        <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
            <p class="section-eyebrow text-brand-600">Our Portfolio</p>
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
                @include('partials.project-card', ['slug' => $project->slug, 'project' => $project])
            @endforeach
        </div>

        {{-- View all (centered) --}}
        <div class="mt-12 flex justify-center">
            <a href="{{ route('projects') }}" class="group inline-flex items-center gap-2 rounded-full border border-brand-200 px-7 py-3 text-sm font-semibold text-brand-700 transition hover:border-brand-400 hover:bg-brand-50">
                View All Projects
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
