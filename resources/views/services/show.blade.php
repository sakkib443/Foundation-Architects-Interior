@extends('layouts.app')

@section('title', $service['title'] . ' — ' . config('app.name'))
@section('meta_description', $service['summary'])

@section('content')

    {{-- ======================= PAGE HERO ======================= --}}
    @include('partials.page-hero', [
        'image'    => $service['image'],
        'eyebrow'  => 'Our Service',
        'title'    => $service['title'],
        'subtitle' => $service['tagline'],
        'crumb'    => $service['title'],
    ])

    {{-- ======================= INTRO ======================= --}}
    <section class="bg-brand-50 py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Back link --}}
            <a href="{{ route('services') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 transition hover:text-brand-800">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                All services
            </a>

            {{-- Intro --}}
            <div class="mt-8 max-w-3xl">
                <p class="font-script text-3xl leading-none text-brand-600 sm:text-4xl">{{ $service['tagline'] }}</p>
                <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-brand-900 sm:text-4xl">
                    {{ $service['title'] }}
                </h2>
                <p class="mt-5 text-lg leading-relaxed text-stone-600">
                    {{ $service['intro'] }}
                </p>
            </div>

            {{-- What's included --}}
            <div class="mt-14">
                <h3 class="font-display text-2xl font-bold text-brand-900">What's included</h3>
                <div class="mt-7 grid gap-6 sm:grid-cols-2">
                    @foreach ($service['features'] as $feature)
                        <div class="flex items-start gap-4 rounded-2xl border border-stone-100 bg-white p-6 shadow-sm ring-1 ring-stone-900/5">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-brand-100 text-brand-700">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                </svg>
                            </span>
                            <div>
                                <p class="font-display text-lg font-semibold text-brand-900">{{ $feature['title'] }}</p>
                                <p class="mt-1 text-sm leading-relaxed text-stone-500">{{ $feature['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- CTA --}}
            <div class="mt-14 flex flex-col items-center gap-5 rounded-3xl bg-gradient-to-br from-brand-600 to-brand-800 px-6 py-12 text-center shadow-xl shadow-brand-900/20 sm:px-12">
                <h3 class="font-display text-2xl font-bold text-white sm:text-3xl">
                    Ready to start your {{ strtolower($service['title']) }} project?
                </h3>
                <p class="max-w-xl text-brand-100">
                    Tell us about your space and we'll get back within one working day with the next steps.
                </p>
                <a href="{{ route('contact') }}"
                   class="group inline-flex items-center gap-2 rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-brand-700 shadow-lg transition hover:bg-brand-50">
                    Get a free consultation
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

@endsection
