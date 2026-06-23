@php
    $cta = $settings->get('about.cta', []);
    $cta = is_array($cta) ? $cta : [];

    $ctaTagline  = $cta['tagline'] ?? "Let's Work Together";
    $ctaHeadline = $cta['headline'] ?? 'Ready to Build Your Dream Space?';
    $ctaSubtitle = $cta['subtitle'] ?? "Tell us about your space and your vision — our team will turn it into a place you'll love to live and work in. Your free consultation is just one call away.";

    $ctaButtons = (! empty($cta['buttons']) && is_array($cta['buttons'])) ? array_values($cta['buttons']) : [
        ['label' => 'Free Consultation', 'href' => 'tel:+8801722752657'],
        ['label' => 'View Our Work', 'href' => '#projects'],
    ];

    // A bare #fragment links to the homepage anchor (preserving the original
    // route('home').'#projects' behaviour); everything else passes through.
    $ctaHref = fn ($href) => $href !== '' && str_starts_with($href, '#') ? route('home').$href : ($href ?: '#');
@endphp

<section class="bg-white pb-20 sm:pb-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-600 via-brand-700 to-brand-900 px-6 py-14 text-center shadow-2xl shadow-brand-900/30 sm:px-12 sm:py-20">

            {{-- Decorative glows --}}
            <div class="pointer-events-none absolute -left-16 -top-16 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-20 -right-10 h-72 w-72 rounded-full bg-brand-400/20 blur-3xl"></div>

            <div class="relative mx-auto max-w-2xl">
                <p class="font-script text-3xl leading-none text-brand-200 sm:text-4xl">{{ $ctaTagline }}</p>
                <h2 class="mt-3 font-display text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">
                    {{ $ctaHeadline }}
                </h2>
                <p class="mx-auto mt-4 max-w-xl text-white/85">
                    {{ $ctaSubtitle }}
                </p>

                <div class="mt-9 flex flex-wrap items-center justify-center gap-4">
                    @if (isset($ctaButtons[0]))
                        <a href="{{ $ctaHref($ctaButtons[0]['href'] ?? '#') }}"
                           class="inline-flex items-center gap-2 rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-brand-700 shadow-lg transition hover:bg-brand-50">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                            </svg>
                            {{ $ctaButtons[0]['label'] ?? '' }}
                        </a>
                    @endif
                    @if (isset($ctaButtons[1]))
                        <a href="{{ $ctaHref($ctaButtons[1]['href'] ?? '#') }}"
                           class="inline-flex items-center gap-2 rounded-full border border-white/40 bg-white/10 px-7 py-3.5 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20">
                            {{ $ctaButtons[1]['label'] ?? '' }}
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
