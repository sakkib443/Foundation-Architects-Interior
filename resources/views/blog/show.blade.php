@extends('layouts.app')

@section('title', $post['title'] . ' — ' . config('app.name'))
@section('meta_description', $post['excerpt'])

@section('content')

    {{-- ======================= PAGE HERO ======================= --}}
    @include('partials.page-hero', [
        'image'    => $post['image'],
        'eyebrow'  => $post['category'],
        'title'    => $post['title'],
        'subtitle' => $post['excerpt'],
        'crumb'    => 'Blog',
    ])

    {{-- ======================= ARTICLE ======================= --}}
    <section class="bg-brand-50 py-20 sm:py-28">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            {{-- Back link --}}
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 transition hover:text-brand-800">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                All articles
            </a>

            {{-- Meta --}}
            <div class="mt-8 flex flex-wrap items-center gap-3 text-sm text-stone-400">
                <span class="inline-flex rounded-full bg-brand-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-brand-700">
                    {{ $post['category'] }}
                </span>
                <span class="inline-flex items-center gap-1.5">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $post['date'] }}
                </span>
                <span class="h-1 w-1 rounded-full bg-stone-300"></span>
                <span class="inline-flex items-center gap-1.5">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $post['read'] }} min read
                </span>
            </div>

            {{-- Title --}}
            <h1 class="mt-5 font-display text-3xl font-bold leading-tight text-brand-900 sm:text-4xl">
                {{ $post['title'] }}
            </h1>

            {{-- Body --}}
            <div class="mt-8 space-y-6 text-lg leading-relaxed text-stone-600">
                @foreach ($post['body'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

            {{-- Footer CTA --}}
            <div class="mt-12 flex flex-col items-start gap-4 rounded-2xl border border-brand-100 bg-white p-7 shadow-sm ring-1 ring-stone-900/5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="font-display text-lg font-semibold text-brand-900">Thinking about your own space?</p>
                    <p class="mt-1 text-sm text-stone-500">We'd love to help you design it.</p>
                </div>
                <a href="{{ route('contact') }}"
                   class="group inline-flex shrink-0 items-center gap-2 rounded-full bg-gradient-to-r from-brand-400 to-brand-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:from-brand-500 hover:to-brand-700">
                    Get in touch
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

@endsection
