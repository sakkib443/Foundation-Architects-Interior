{{--
    Shared inner-page hero (with smooth staggered entrance animation).
    Expects:
        $image    — background image path (e.g. 'images/hero/slide-2.jpg')
        $eyebrow  — small script line above the title
        $title    — main H1 text
        $subtitle — supporting line under the title
        $crumb    — breadcrumb label for the current page
--}}
<section class="relative flex min-h-[54vh] flex-col justify-center overflow-hidden pb-16 pt-36 sm:pt-44">
    {{-- Background --}}
    <div class="absolute inset-0">
        <img src="{{ asset($image) }}" alt="" class="hero-bg-zoom h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/55 to-brand-900/85"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto w-full max-w-7xl px-4 text-center sm:px-6 lg:px-8">
        <p class="hero-rise hero-text-shadow font-script text-3xl leading-none text-brand-200 sm:text-4xl lg:text-5xl"
           style="--rise-delay: 0.1s">
            {{ $eyebrow }}
        </p>
        <h1 class="hero-rise hero-text-shadow mt-3 font-display text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl"
            style="--rise-delay: 0.25s">
            {{ $title }}
        </h1>
        <p class="hero-rise hero-text-shadow mx-auto mt-5 max-w-2xl text-base text-white/90 sm:text-lg"
           style="--rise-delay: 0.4s">
            {{ $subtitle }}
        </p>

        {{-- Breadcrumb --}}
        <nav class="hero-rise mt-7 flex items-center justify-center gap-2 text-sm font-medium text-white/80"
             style="--rise-delay: 0.55s">
            <a href="{{ route('home') }}" class="transition hover:text-white">Home</a>
            <svg class="h-4 w-4 text-white/50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white">{{ $crumb }}</span>
        </nav>
    </div>
</section>
