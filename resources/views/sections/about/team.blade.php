@php
    // Drop matching photos at public/images/team/<photo> to replace the initials avatars automatically.
    $team = \App\Models\TeamMember::where('is_published', true)->orderBy('sort_order')->get();

    $socials = [
        'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z', // facebook
        'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.332.014 7.052.072 2.695.272.273 2.69.073 7.052.014 8.332 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.332 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.668-.072-4.948-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z', // instagram
        'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z', // linkedin
    ];
@endphp

<section class="bg-white py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
            <p class="section-eyebrow text-brand-600">The People</p>
            <h2 class="mt-3 font-display text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl">
                Meet the Team
            </h2>
            <p class="mt-4 text-stone-500">
                A dedicated team of architects, designers, and 3D artists bringing your vision to life.
            </p>
        </div>

        {{-- Grid --}}
        <div class="mt-14 grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-4">
            @foreach ($team as $i => $member)
                @php
                    $initials = collect(explode(' ', $member['name']))->filter(fn ($w) => ctype_alpha($w[0] ?? ''))->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->implode('');
                    $hasPhoto = ! empty($member['photo']) && file_exists(public_path($member['photo']));
                @endphp
                <div class="group overflow-hidden rounded-2xl border border-stone-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1.5 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-500/10">
                    {{-- Avatar --}}
                    <div class="relative aspect-square overflow-hidden">
                        @if ($hasPhoto)
                            <img src="{{ asset($member['photo']) }}" alt="{{ $member['name'] }}" loading="lazy"
                                 class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                        @else
                            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-brand-400 to-brand-700">
                                <span class="font-display text-4xl font-bold text-white/90">{{ $initials }}</span>
                            </div>
                        @endif

                        {{-- Social hover bar --}}
                        <div class="absolute inset-x-0 bottom-0 flex translate-y-full items-center justify-center gap-2 bg-gradient-to-t from-black/70 to-transparent p-3 transition-transform duration-300 group-hover:translate-y-0">
                            @foreach ($socials as $path)
                                <a href="#" aria-label="Social profile"
                                   class="flex h-8 w-8 items-center justify-center rounded-full bg-white/90 text-brand-700 transition hover:bg-white">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $path }}"/></svg>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Name --}}
                    <div class="p-4 text-center">
                        <h3 class="font-display text-base font-semibold text-brand-900">{{ $member['name'] }}</h3>
                        <p class="mt-0.5 text-xs font-medium uppercase tracking-wide text-brand-600">{{ $member['role'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
