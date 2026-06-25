@extends('layouts.app')

@section('title', config('app.name') . ' — Design for Life')

@php
    $slides = $settings->get('homepage.hero.slides', [
        'images/hero/slide-1.jpg',
        'images/hero/slide-2.jpg',
        'images/hero/slide-3.jpg',
    ]);
    $heroButtons = $settings->get('homepage.hero.buttons', [
        ['label' => 'View Projects', 'href' => '#projects'],
        ['label' => 'Free Consultation', 'href' => 'tel:+8801722752657'],
    ]);
@endphp

@section('content')

    {{-- ===================== HERO ===================== --}}
    <section id="home" class="relative h-screen min-h-[600px] w-full overflow-hidden">

        {{-- Background slides --}}
        <div class="absolute inset-0">
            @foreach ($slides as $i => $slide)
                <div data-hero-slide
                     class="hero-bg-zoom absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}"
                     style="background-image: url('{{ asset($slide) }}')"></div>
            @endforeach
            {{-- Light, even overlay for readability (no harsh dark patches) --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/45"></div>
        </div>

        {{-- Content (all centered together) --}}
        <div class="relative z-10 flex h-full flex-col items-center justify-center px-4 text-center sm:px-6">

            {{-- Cursive tagline --}}
            <p class="hero-rise hero-text-shadow font-script text-base font-medium leading-snug text-white sm:text-lg lg:text-xl"
               style="--rise-delay: 0.15s">
                {{ $settings->get('homepage.hero.tagline', 'Foundation Architects & Interior, Design for Life.') }}
            </p>

            {{-- Headline + sub + buttons --}}
            <div class="mt-6 flex max-w-3xl flex-col items-center">
                <h1 class="hero-rise hero-text-shadow font-display text-3xl font-semibold leading-tight text-white sm:text-5xl"
                    style="--rise-delay: 0.4s">
                    {{ $settings->get('homepage.hero.headline', 'Crafting Beautiful Interiors Across Bangladesh') }}
                </h1>
                <p class="hero-rise hero-text-shadow mt-4 max-w-xl text-base text-white/90 sm:text-lg"
                   style="--rise-delay: 0.6s">
                    {{ $settings->get('homepage.hero.subtitle', "A trusted name in the interior sector — turning your space into a place you'll love to live and work in.") }}
                </p>

                <div class="hero-rise mt-8 flex flex-wrap items-center justify-center gap-4"
                     style="--rise-delay: 0.8s">
                    @if (!empty($heroButtons[0]))
                        <a href="{{ $heroButtons[0]['href'] ?? '#' }}"
                           class="inline-flex items-center gap-2 rounded-full border border-white/50 bg-white/10 px-7 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                            </svg>
                            {{ $heroButtons[0]['label'] ?? '' }}
                        </a>
                    @endif
                    @if (!empty($heroButtons[1]))
                        <a href="{{ $heroButtons[1]['href'] ?? '#' }}"
                           class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-brand-400 to-brand-600 px-7 py-3 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:from-brand-500 hover:to-brand-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                            </svg>
                            {{ $heroButtons[1]['label'] ?? '' }}
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Carousel dots (bottom) --}}
        <div class="hero-rise absolute inset-x-0 bottom-8 z-10 flex items-center justify-center gap-2"
             style="--rise-delay: 1s">
            @foreach ($slides as $i => $slide)
                <button data-hero-dot aria-label="Go to slide {{ $i + 1 }}"
                        class="h-2.5 rounded-full transition-all duration-300 {{ $i === 0 ? 'w-8 bg-white' : 'w-2.5 bg-white/50' }}"></button>
            @endforeach
        </div>
    </section>

    {{-- ===================== PORTFOLIO ===================== --}}
    @include('sections.portfolio')

    {{-- ===================== STATS ===================== --}}
    @include('sections.stats')

    {{-- ===================== ABOUT ===================== --}}
    @include('sections.about')

    {{-- ===================== PROCESS ===================== --}}
    @include('sections.process')

    {{-- ===================== TESTIMONIALS ===================== --}}
    @include('sections.testimonials')

    {{-- ===================== BLOG ===================== --}}
    @include('sections.blog')

@endsection
