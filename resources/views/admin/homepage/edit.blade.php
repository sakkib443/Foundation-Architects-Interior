@extends('layouts.admin')

@section('title', 'Homepage')
@section('heading', 'Homepage')

@php
    // Pull the current group with safe fallbacks so the form renders pre-seed.
    $hero        = $home['hero'] ?? [];
    $heroSlides  = array_values((array) ($hero['slides'] ?? []));
    $heroButtons = array_values((array) ($hero['buttons'] ?? []));
    $stats       = array_values((array) ($home['stats'] ?? []));
    $process     = array_values((array) ($home['process'] ?? []));
    $about       = $home['about'] ?? [];
    $features    = array_values((array) ($about['features'] ?? []));
    $badge2      = (array) ($about['badge2'] ?? []);

    $inputClass = 'mt-2 block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30';
    $rowInputClass = 'block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30';
@endphp

@section('content')
    <p class="text-sm text-stone-500">Edit the public home page: the hero, the stats bar, the working-process steps and the &ldquo;about intro&rdquo; block. Changes go live immediately.</p>

    <form method="POST" action="{{ route('admin.homepage.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div data-tabs>
            {{-- Tab nav --}}
            <nav class="mb-6 flex flex-wrap gap-1 overflow-x-auto border-b border-stone-200">
                <button type="button" data-tab="hero" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition border-brand-600 text-brand-700">Hero</button>
                <button type="button" data-tab="stats" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition border-transparent text-stone-500 hover:text-brand-700">Stats bar</button>
                <button type="button" data-tab="process" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition border-transparent text-stone-500 hover:text-brand-700">Working process</button>
                <button type="button" data-tab="about" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition border-transparent text-stone-500 hover:text-brand-700">About intro</button>
            </nav>

        {{-- ============================ HERO ============================ --}}
        <section data-panel="hero" class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Hero</h2>
            <p class="mt-1 text-sm text-stone-500">The full-screen banner at the top of the home page.</p>

            <div class="mt-5 space-y-5">
                <x-form.input name="hero[tagline]" label="Tagline (script)" :value="$hero['tagline'] ?? ''" />
                <x-form.input name="hero[headline]" label="Headline" :value="$hero['headline'] ?? ''" />
                <x-form.textarea name="hero[subtitle]" label="Subtitle" :value="$hero['subtitle'] ?? ''" rows="2" />

                {{-- Slides (existing kept via hidden path; add more below) --}}
                <div>
                    <label class="block text-sm font-medium text-brand-900">Background slides</label>
                    <p class="mt-1 text-xs text-stone-400">Uncheck an image to remove it from the slideshow. Add more using the field below.</p>

                    @if (!empty($heroSlides))
                        <div class="mt-3 grid grid-cols-2 gap-4 sm:grid-cols-3">
                            @foreach ($heroSlides as $i => $slide)
                                <label class="group relative block cursor-pointer overflow-hidden rounded-xl ring-1 ring-stone-200">
                                    <img src="{{ asset($slide) }}" alt="" class="aspect-video w-full object-cover transition group-has-[:not(:checked)]:opacity-30">
                                    <span class="absolute left-2 top-2 inline-flex items-center gap-1.5 rounded-full bg-white/90 px-2.5 py-1 text-xs font-semibold text-stone-700 shadow-sm backdrop-blur">
                                        <input type="checkbox" name="hero_slides[{{ $i }}]" value="{{ $slide }}" checked class="h-3.5 w-3.5 rounded border-stone-300 text-brand-600 focus:ring-brand-500">
                                        Keep
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-3 text-sm text-stone-400">No slides yet.</p>
                    @endif

                    <div class="mt-4">
                        <label for="hero_slides_new" class="block text-sm font-medium text-brand-900">Add slides</label>
                        <input type="file" name="hero_slides_new[]" id="hero_slides_new" multiple accept="image/*"
                            class="mt-2 block w-full text-sm text-stone-500 file:mr-4 file:rounded-full file:border-0 file:bg-brand-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-700 hover:file:bg-brand-100">
                        <p class="mt-1 text-xs text-stone-400">JPG/PNG/WebP. You can select multiple files.</p>
                        @error('hero_slides_new.*')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Buttons repeater --}}
                <div>
                    <label class="block text-sm font-medium text-brand-900">Buttons</label>
                    <p class="mt-1 text-xs text-stone-400">Label and link (e.g. <code>#projects</code> or <code>tel:+8801722752657</code>).</p>

                    <div class="mt-3" data-repeater data-next="{{ count($heroButtons) }}">
                        <div class="space-y-3" data-repeater-items>
                            @foreach ($heroButtons as $i => $btn)
                                <div class="flex items-center gap-3" data-repeater-row>
                                    <input type="text" name="hero_buttons[{{ $i }}][label]" value="{{ $btn['label'] ?? '' }}" placeholder="Label" class="{{ $rowInputClass }}">
                                    <input type="text" name="hero_buttons[{{ $i }}][href]" value="{{ $btn['href'] ?? '' }}" placeholder="Link" class="{{ $rowInputClass }}">
                                    <button type="button" data-repeater-remove class="shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <template data-repeater-template>
                            <div class="flex items-center gap-3" data-repeater-row>
                                <input type="text" name="hero_buttons[__i__][label]" value="" placeholder="Label" class="{{ $rowInputClass }}">
                                <input type="text" name="hero_buttons[__i__][href]" value="" placeholder="Link" class="{{ $rowInputClass }}">
                                <button type="button" data-repeater-remove class="shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </template>

                        <button type="button" data-repeater-add class="mt-4 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Add button
                        </button>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================ STATS ============================ --}}
        <section data-panel="stats" class="hidden rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Stats bar</h2>
            <p class="mt-1 text-sm text-stone-500">The coloured strip of figures below the portfolio. Icon is raw inner SVG markup (advanced).</p>

            <div class="mt-5" data-repeater data-next="{{ count($stats) }}">
                <div class="space-y-3" data-repeater-items>
                    @foreach ($stats as $i => $stat)
                        <div class="grid items-start gap-3 sm:grid-cols-[7rem_1fr_2fr_auto]" data-repeater-row>
                            <input type="text" name="stats[{{ $i }}][value]" value="{{ $stat['value'] ?? '' }}" placeholder="15+" class="{{ $rowInputClass }}">
                            <input type="text" name="stats[{{ $i }}][label]" value="{{ $stat['label'] ?? '' }}" placeholder="Awards Won" class="{{ $rowInputClass }}">
                            <input type="text" name="stats[{{ $i }}][icon]" value="{{ $stat['icon'] ?? '' }}" placeholder="<path d=&quot;…&quot;/>" class="{{ $rowInputClass }} font-mono text-xs">
                            <button type="button" data-repeater-remove class="mt-0.5 shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    @endforeach
                </div>

                <template data-repeater-template>
                    <div class="grid items-start gap-3 sm:grid-cols-[7rem_1fr_2fr_auto]" data-repeater-row>
                        <input type="text" name="stats[__i__][value]" value="" placeholder="15+" class="{{ $rowInputClass }}">
                        <input type="text" name="stats[__i__][label]" value="" placeholder="Awards Won" class="{{ $rowInputClass }}">
                        <input type="text" name="stats[__i__][icon]" value="" placeholder="<path d=&quot;…&quot;/>" class="{{ $rowInputClass }} font-mono text-xs">
                        <button type="button" data-repeater-remove class="mt-0.5 shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </template>

                <button type="button" data-repeater-add class="mt-4 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Add stat
                </button>
            </div>
        </section>

        {{-- =========================== PROCESS =========================== --}}
        <section data-panel="process" class="hidden rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Working process</h2>
            <p class="mt-1 text-sm text-stone-500">The numbered step cards. Icon is a single SVG path &ldquo;d&rdquo; string (advanced).</p>

            <div class="mt-5" data-repeater data-next="{{ count($process) }}">
                <div class="space-y-4" data-repeater-items>
                    @foreach ($process as $i => $step)
                        <div class="rounded-xl border border-stone-200 p-4" data-repeater-row>
                            <div class="flex items-start justify-between gap-3">
                                <div class="grid flex-1 gap-3 sm:grid-cols-2">
                                    <input type="text" name="process[{{ $i }}][title]" value="{{ $step['title'] ?? '' }}" placeholder="Title" class="{{ $rowInputClass }}">
                                    <input type="text" name="process[{{ $i }}][time]" value="{{ $step['time'] ?? '' }}" placeholder="1–2 weeks" class="{{ $rowInputClass }}">
                                    <input type="text" name="process[{{ $i }}][description]" value="{{ $step['description'] ?? '' }}" placeholder="Description" class="{{ $rowInputClass }} sm:col-span-2">
                                    <input type="text" name="process[{{ $i }}][icon]" value="{{ $step['icon'] ?? '' }}" placeholder="M8 12h.01…" class="{{ $rowInputClass }} font-mono text-xs sm:col-span-2">
                                </div>
                                <button type="button" data-repeater-remove class="shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <template data-repeater-template>
                    <div class="rounded-xl border border-stone-200 p-4" data-repeater-row>
                        <div class="flex items-start justify-between gap-3">
                            <div class="grid flex-1 gap-3 sm:grid-cols-2">
                                <input type="text" name="process[__i__][title]" value="" placeholder="Title" class="{{ $rowInputClass }}">
                                <input type="text" name="process[__i__][time]" value="" placeholder="1–2 weeks" class="{{ $rowInputClass }}">
                                <input type="text" name="process[__i__][description]" value="" placeholder="Description" class="{{ $rowInputClass }} sm:col-span-2">
                                <input type="text" name="process[__i__][icon]" value="" placeholder="M8 12h.01…" class="{{ $rowInputClass }} font-mono text-xs sm:col-span-2">
                            </div>
                            <button type="button" data-repeater-remove class="shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                </template>

                <button type="button" data-repeater-add class="mt-4 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Add step
                </button>
            </div>
        </section>

        {{-- ======================== ABOUT INTRO ======================== --}}
        <section data-panel="about" class="hidden rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">About intro</h2>
            <p class="mt-1 text-sm text-stone-500">The two-column &ldquo;About Us&rdquo; block on the home page (images + text + feature cards).</p>

            <div class="mt-5 space-y-5">
                <x-form.input name="about[headline]" label="Headline" :value="$about['headline'] ?? ''" />
                <x-form.textarea name="about[body]" label="Body" :value="$about['body'] ?? ''" rows="4" />

                {{-- Images --}}
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <x-form.file name="about_image_main" label="Main image" :current="$about['image_main'] ?? null" />
                        <input type="hidden" name="about_image_main_keep" value="{{ $about['image_main'] ?? '' }}">
                    </div>
                    <div>
                        <x-form.file name="about_image_secondary" label="Secondary image" :current="$about['image_secondary'] ?? null" />
                        <input type="hidden" name="about_image_secondary_keep" value="{{ $about['image_secondary'] ?? '' }}">
                    </div>
                </div>

                {{-- Badges --}}
                <div class="grid gap-5 sm:grid-cols-3">
                    <x-form.input name="about[badge]" label="Top badge text" :value="$about['badge'] ?? ''" hint="e.g. 100% Satisfaction" />
                    <x-form.input name="about_badge2[value]" label="Stat badge value" :value="$badge2['value'] ?? ''" hint="e.g. 10+" />
                    <x-form.input name="about_badge2[label]" label="Stat badge label" :value="$badge2['label'] ?? ''" hint="e.g. Years Experience" />
                </div>

                {{-- Feature cards repeater --}}
                <div>
                    <label class="block text-sm font-medium text-brand-900">Feature cards</label>
                    <p class="mt-1 text-xs text-stone-400">The 2&times;2 grid of selling points. Icon is a single SVG path &ldquo;d&rdquo; string (advanced).</p>

                    <div class="mt-3" data-repeater data-next="{{ count($features) }}">
                        <div class="space-y-3" data-repeater-items>
                            @foreach ($features as $i => $feature)
                                <div class="grid items-start gap-3 sm:grid-cols-[1fr_1fr_2fr_auto]" data-repeater-row>
                                    <input type="text" name="about_features[{{ $i }}][title]" value="{{ $feature['title'] ?? '' }}" placeholder="Title" class="{{ $rowInputClass }}">
                                    <input type="text" name="about_features[{{ $i }}][description]" value="{{ $feature['description'] ?? '' }}" placeholder="Description" class="{{ $rowInputClass }}">
                                    <input type="text" name="about_features[{{ $i }}][icon]" value="{{ $feature['icon'] ?? '' }}" placeholder="M9.813 15.904…" class="{{ $rowInputClass }} font-mono text-xs">
                                    <button type="button" data-repeater-remove class="mt-0.5 shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <template data-repeater-template>
                            <div class="grid items-start gap-3 sm:grid-cols-[1fr_1fr_2fr_auto]" data-repeater-row>
                                <input type="text" name="about_features[__i__][title]" value="" placeholder="Title" class="{{ $rowInputClass }}">
                                <input type="text" name="about_features[__i__][description]" value="" placeholder="Description" class="{{ $rowInputClass }}">
                                <input type="text" name="about_features[__i__][icon]" value="" placeholder="M9.813 15.904…" class="{{ $rowInputClass }} font-mono text-xs">
                                <button type="button" data-repeater-remove class="mt-0.5 shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </template>

                        <button type="button" data-repeater-add class="mt-4 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Add feature
                        </button>
                    </div>
                </div>
            </div>
        </section>

        </div>{{-- /data-tabs --}}

        {{-- Save --}}
        <div class="flex justify-end">
            <button type="submit" class="rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md focus:outline-none focus:ring-2 focus:ring-brand-500/40">
                Save homepage
            </button>
        </div>
    </form>
@endsection
