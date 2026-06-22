@extends('layouts.app')

@section('title', 'About Us — ' . config('app.name'))
@section('meta_description', 'Get to know Foundation Architects & Interior — a Dhaka-based architecture & interior design studio crafting beautiful, functional spaces since 2016 with faith, honesty, and craftsmanship.')

@section('content')

    {{-- ======================= PAGE HERO ======================= --}}
    <section class="relative flex min-h-[54vh] flex-col justify-center overflow-hidden pb-14 pt-28 sm:pt-32">
        {{-- Background --}}
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero/slide-2.jpg') }}" alt="" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/55 to-brand-900/85"></div>
        </div>

        {{-- Content --}}
        <div class="relative z-10 mx-auto w-full max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <p class="hero-text-shadow font-script text-3xl leading-none text-brand-200 sm:text-4xl lg:text-5xl">
                Get to Know Us
            </p>
            <h1 class="hero-text-shadow mt-3 font-display text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl">
                About Foundation Architects &amp; Interior
            </h1>
            <p class="hero-text-shadow mx-auto mt-5 max-w-2xl text-base text-white/90 sm:text-lg">
                Where vision meets craftsmanship — a studio built on faith, honesty, and a passion for
                designing spaces that feel like home.
            </p>

            {{-- Breadcrumb --}}
            <nav class="mt-7 flex items-center justify-center gap-2 text-sm font-medium text-white/80">
                <a href="{{ route('home') }}" class="transition hover:text-white">Home</a>
                <svg class="h-4 w-4 text-white/50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white">About Us</span>
            </nav>
        </div>
    </section>

    {{-- ======================= SECTIONS ======================= --}}
    @include('sections.about.story')
    @include('sections.stats')
    @include('sections.about.vision-mission')
    @include('sections.about.timeline')
    @include('sections.about.founder')
    @include('sections.about.team')
    @include('sections.about.values')
    @include('sections.about.cta')

@endsection
