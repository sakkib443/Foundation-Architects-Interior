{{-- Single service card. Expects: $slug, $service (title, tagline, icon, summary) --}}
<a href="{{ route('services.show', $slug) }}"
   class="group flex flex-col rounded-2xl border border-stone-100 bg-white p-7 shadow-sm ring-1 ring-stone-900/5 transition duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-stone-900/10">

    {{-- Icon --}}
    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-400 to-brand-600 text-white shadow-lg shadow-brand-500/30 transition group-hover:scale-110">
        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service['icon'] }}"/>
        </svg>
    </span>

    {{-- Title + tagline --}}
    <h3 class="mt-6 font-display text-xl font-bold text-brand-900 transition group-hover:text-brand-700">
        {{ $service['title'] }}
    </h3>
    <p class="mt-1 text-sm font-medium text-brand-500">{{ $service['tagline'] }}</p>

    {{-- Summary --}}
    <p class="mt-3 flex-1 text-sm leading-relaxed text-stone-500">
        {{ $service['summary'] }}
    </p>

    {{-- Link --}}
    <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 transition group-hover:text-brand-800">
        Learn more
        <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
    </span>
</a>
