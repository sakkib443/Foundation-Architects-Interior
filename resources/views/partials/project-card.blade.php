{{-- Single project card. Expects: $slug, $project (title, category, image) --}}
<a href="{{ route('projects.show', $slug) }}"
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
