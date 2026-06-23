@extends('layouts.app')

@section('title', $project['title'] . ' — ' . config('app.name'))
@section('meta_description', $project['summary'])

@section('content')

    {{-- ======================= PAGE HERO ======================= --}}
    @include('partials.page-hero', [
        'image'    => $project['image'],
        'eyebrow'  => $project['category'],
        'title'    => $project['title'],
        'subtitle' => $project['summary'],
        'crumb'    => $project['title'],
    ])

    {{-- ======================= DETAILS ======================= --}}
    <section class="bg-brand-50 py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Back link --}}
            <a href="{{ route('projects') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 transition hover:text-brand-800">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                All projects
            </a>

            {{-- Meta strip --}}
            <dl class="mt-8 grid grid-cols-2 gap-px overflow-hidden rounded-2xl bg-stone-200 ring-1 ring-stone-200 sm:grid-cols-4">
                @foreach ([
                    'Category' => $project['category'],
                    'Location' => $project['location'],
                    'Year'     => $project['year'],
                    'Area'     => $project['area'],
                ] as $label => $value)
                    <div class="bg-white p-5">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-brand-600">{{ $label }}</dt>
                        <dd class="mt-1 font-display text-base font-semibold text-brand-900">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>

            {{-- Overview + scope --}}
            <div class="mt-12 grid gap-10 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <p class="font-script text-3xl leading-none text-brand-600 sm:text-4xl">The Project</p>
                    <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-brand-900 sm:text-4xl">Overview</h2>
                    <p class="mt-5 text-lg leading-relaxed text-stone-600">{{ $project['overview'] }}</p>
                </div>

                <div>
                    <h3 class="font-display text-xl font-bold text-brand-900">Scope of work</h3>
                    <ul class="mt-5 space-y-3">
                        @foreach ($project['scope'] as $item)
                            <li class="flex items-start gap-3 text-stone-600">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-brand-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                </svg>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Gallery --}}
            <div class="mt-14">
                <h3 class="font-display text-2xl font-bold text-brand-900">Gallery</h3>
                <div class="mt-7 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($project['gallery'] as $image)
                        <div class="aspect-[4/3] overflow-hidden rounded-2xl shadow-sm ring-1 ring-stone-900/5">
                            <img src="{{ asset($image) }}" alt="{{ $project['title'] }}" loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-700 ease-out hover:scale-105">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- CTA --}}
            <div class="mt-14 flex flex-col items-center gap-5 rounded-3xl bg-gradient-to-br from-brand-600 to-brand-800 px-6 py-12 text-center shadow-xl shadow-brand-900/20 sm:px-12">
                <h3 class="font-display text-2xl font-bold text-white sm:text-3xl">Have a space like this in mind?</h3>
                <p class="max-w-xl text-brand-100">Let's talk about your project — we'll help you turn it into a space you'll love.</p>
                <a href="{{ route('contact') }}"
                   class="group inline-flex items-center gap-2 rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-brand-700 shadow-lg transition hover:bg-brand-50">
                    Start your project
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

@endsection
