@extends('layouts.admin')

@section('title', 'About Page')
@section('heading', 'About Page')

@php
    $inputClass = 'block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30';

    // Repeater datasets (old() first so validation errors keep edits).
    $paragraphs = old('story.paragraphs', $about['story']['paragraphs'] ?? []);
    $paragraphs = is_array($paragraphs) ? array_values($paragraphs) : [];

    $highlights = old('story.highlights', $about['story']['highlights'] ?? []);
    $highlights = is_array($highlights) ? array_values($highlights) : [];

    $images = old('story.images', $about['story']['images'] ?? []);
    $images = is_array($images) ? array_values($images) : [];

    $pillars = old('vision_mission', $about['vision_mission'] ?? []);
    $pillars = is_array($pillars) ? array_values($pillars) : [];

    $timeline = old('timeline', $about['timeline'] ?? []);
    $timeline = is_array($timeline) ? array_values($timeline) : [];

    $stats = old('founder.stats', $about['founder']['stats'] ?? []);
    $stats = is_array($stats) ? array_values($stats) : [];

    $values = old('values', $about['values'] ?? []);
    $values = is_array($values) ? array_values($values) : [];

    $buttons = old('cta.buttons', $about['cta']['buttons'] ?? []);
    $buttons = is_array($buttons) ? array_values($buttons) : [];

    $founderPhoto = $about['founder']['photo'] ?? null;
@endphp

@section('content')
    <p class="text-sm text-stone-500">Every section of the public <a href="{{ route('about') }}" target="_blank" class="font-medium text-brand-600 hover:text-brand-800">About page</a>. Leave any field blank to fall back to its built-in default.</p>

    <form method="POST" action="{{ route('admin.site-content.about.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div data-tabs>
            {{-- Tab nav --}}
            <nav class="mb-6 flex flex-wrap gap-1 overflow-x-auto border-b border-stone-200">
                <button type="button" data-tab="story" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition border-brand-600 text-brand-700">Our Story</button>
                <button type="button" data-tab="vision" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition border-transparent text-stone-500 hover:text-brand-700">Vision &amp; Mission</button>
                <button type="button" data-tab="timeline" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition border-transparent text-stone-500 hover:text-brand-700">Timeline</button>
                <button type="button" data-tab="founder" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition border-transparent text-stone-500 hover:text-brand-700">Founder</button>
                <button type="button" data-tab="values" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition border-transparent text-stone-500 hover:text-brand-700">Why Choose Us</button>
                <button type="button" data-tab="cta" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition border-transparent text-stone-500 hover:text-brand-700">Call to action</button>
            </nav>

        {{-- ===================== 1. STORY ===================== --}}
        <section data-panel="story" class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Our Story</h2>
            <p class="mt-1 text-sm text-stone-500">The intro section with the headline, body paragraphs, highlight points, the floating experience badge and the image collage.</p>

            <div class="mt-5 space-y-5">
                <x-form.input name="story[headline]" label="Headline" :value="$about['story']['headline'] ?? ''" />

                {{-- Paragraphs --}}
                <div>
                    <label class="block text-sm font-medium text-brand-900">Paragraphs</label>
                    <p class="mt-1 text-xs text-stone-400">Body text under the headline. Empty rows are ignored.</p>
                    <div data-repeater data-next="{{ count($paragraphs) }}" class="mt-3">
                        <div data-repeater-items class="space-y-3">
                            @foreach ($paragraphs as $i => $para)
                                <div data-repeater-row class="flex items-start gap-3">
                                    <textarea name="story[paragraphs][{{ $i }}]" rows="3" placeholder="Paragraph text" class="{{ $inputClass }}">{{ $para }}</textarea>
                                    <button type="button" data-repeater-remove class="mt-1 shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <template data-repeater-template>
                            <div data-repeater-row class="flex items-start gap-3">
                                <textarea name="story[paragraphs][__i__]" rows="3" placeholder="Paragraph text" class="{{ $inputClass }}"></textarea>
                                <button type="button" data-repeater-remove class="mt-1 shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                            </div>
                        </template>
                        <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Add paragraph
                        </button>
                    </div>
                </div>

                {{-- Highlights --}}
                <div>
                    <label class="block text-sm font-medium text-brand-900">Highlights</label>
                    <p class="mt-1 text-xs text-stone-400">The checklist points. Empty rows are ignored.</p>
                    <div data-repeater data-next="{{ count($highlights) }}" class="mt-3">
                        <div data-repeater-items class="space-y-3">
                            @foreach ($highlights as $i => $point)
                                <div data-repeater-row class="flex items-center gap-3">
                                    <input type="text" name="story[highlights][{{ $i }}]" value="{{ $point }}" placeholder="Highlight point" class="{{ $inputClass }}">
                                    <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <template data-repeater-template>
                            <div data-repeater-row class="flex items-center gap-3">
                                <input type="text" name="story[highlights][__i__]" placeholder="Highlight point" class="{{ $inputClass }}">
                                <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                            </div>
                        </template>
                        <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Add highlight
                        </button>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <x-form.input name="story[year]" label="Badge number" :value="$about['story']['year'] ?? ''" hint="The floating badge value, e.g. 10+" />
                    <x-form.input name="story[badge]" label="Badge label" :value="$about['story']['badge'] ?? ''" hint="e.g. Years of Design Excellence" />
                </div>

                {{-- Collage images --}}
                <div>
                    <label class="block text-sm font-medium text-brand-900">Collage images</label>
                    <p class="mt-1 text-xs text-stone-400">Relative image paths for the four-image collage (e.g. images/portfolio/project-1.jpg). Empty rows are ignored.</p>
                    <div data-repeater data-next="{{ count($images) }}" class="mt-3">
                        <div data-repeater-items class="space-y-3">
                            @foreach ($images as $i => $img)
                                <div data-repeater-row class="flex items-center gap-3">
                                    <input type="text" name="story[images][{{ $i }}]" value="{{ $img }}" placeholder="images/portfolio/project-1.jpg" class="{{ $inputClass }}">
                                    <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <template data-repeater-template>
                            <div data-repeater-row class="flex items-center gap-3">
                                <input type="text" name="story[images][__i__]" placeholder="images/portfolio/project-1.jpg" class="{{ $inputClass }}">
                                <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                            </div>
                        </template>
                        <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Add image
                        </button>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===================== 2. VISION & MISSION ===================== --}}
        <section data-panel="vision" class="hidden rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Vision &amp; Mission</h2>
            <p class="mt-1 text-sm text-stone-500">The two pillar cards. Rows with an empty title are ignored. <span class="text-stone-400">Icon = SVG path <code>d</code>; accent = Tailwind gradient classes.</span></p>

            <div data-repeater data-next="{{ count($pillars) }}" class="mt-5">
                <div data-repeater-items class="space-y-3">
                    @foreach ($pillars as $i => $p)
                        <div data-repeater-row class="rounded-xl border border-stone-200 bg-stone-50/60 p-4">
                            <div class="grid gap-3 sm:grid-cols-2">
                                <input type="text" name="vision_mission[{{ $i }}][tag]" value="{{ $p['tag'] ?? '' }}" placeholder="Tag (e.g. Our Vision)" class="{{ $inputClass }}">
                                <input type="text" name="vision_mission[{{ $i }}][title]" value="{{ $p['title'] ?? '' }}" placeholder="Title" class="{{ $inputClass }}">
                            </div>
                            <textarea name="vision_mission[{{ $i }}][description]" rows="3" placeholder="Description" class="{{ $inputClass }} mt-3">{{ $p['description'] ?? '' }}</textarea>
                            <div class="mt-3 grid gap-3 sm:grid-cols-2">
                                <input type="text" name="vision_mission[{{ $i }}][icon]" value="{{ $p['icon'] ?? '' }}" placeholder="Icon SVG path (d)" class="{{ $inputClass }}">
                                <input type="text" name="vision_mission[{{ $i }}][accent]" value="{{ $p['accent'] ?? '' }}" placeholder="Accent (e.g. from-brand-500 to-brand-700)" class="{{ $inputClass }}">
                            </div>
                            <div class="mt-2 text-right">
                                <button type="button" data-repeater-remove class="text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <template data-repeater-template>
                    <div data-repeater-row class="rounded-xl border border-stone-200 bg-stone-50/60 p-4">
                        <div class="grid gap-3 sm:grid-cols-2">
                            <input type="text" name="vision_mission[__i__][tag]" placeholder="Tag (e.g. Our Vision)" class="{{ $inputClass }}">
                            <input type="text" name="vision_mission[__i__][title]" placeholder="Title" class="{{ $inputClass }}">
                        </div>
                        <textarea name="vision_mission[__i__][description]" rows="3" placeholder="Description" class="{{ $inputClass }} mt-3"></textarea>
                        <div class="mt-3 grid gap-3 sm:grid-cols-2">
                            <input type="text" name="vision_mission[__i__][icon]" placeholder="Icon SVG path (d)" class="{{ $inputClass }}">
                            <input type="text" name="vision_mission[__i__][accent]" placeholder="Accent (e.g. from-brand-500 to-brand-700)" class="{{ $inputClass }}">
                        </div>
                        <div class="mt-2 text-right">
                            <button type="button" data-repeater-remove class="text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                        </div>
                    </div>
                </template>
                <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Add pillar
                </button>
            </div>
        </section>

        {{-- ===================== 3. TIMELINE ===================== --}}
        <section data-panel="timeline" class="hidden rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Timeline</h2>
            <p class="mt-1 text-sm text-stone-500">The "A Decade of Growth" milestones. Rows with an empty title are ignored.</p>

            <div data-repeater data-next="{{ count($timeline) }}" class="mt-5">
                <div data-repeater-items class="space-y-3">
                    @foreach ($timeline as $i => $m)
                        <div data-repeater-row class="rounded-xl border border-stone-200 bg-stone-50/60 p-4">
                            <div class="grid gap-3 sm:grid-cols-[8rem_1fr]">
                                <input type="text" name="timeline[{{ $i }}][year]" value="{{ $m['year'] ?? '' }}" placeholder="Year" class="{{ $inputClass }}">
                                <input type="text" name="timeline[{{ $i }}][title]" value="{{ $m['title'] ?? '' }}" placeholder="Title" class="{{ $inputClass }}">
                            </div>
                            <textarea name="timeline[{{ $i }}][description]" rows="2" placeholder="Description" class="{{ $inputClass }} mt-3">{{ $m['description'] ?? '' }}</textarea>
                            <div class="mt-2 text-right">
                                <button type="button" data-repeater-remove class="text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <template data-repeater-template>
                    <div data-repeater-row class="rounded-xl border border-stone-200 bg-stone-50/60 p-4">
                        <div class="grid gap-3 sm:grid-cols-[8rem_1fr]">
                            <input type="text" name="timeline[__i__][year]" placeholder="Year" class="{{ $inputClass }}">
                            <input type="text" name="timeline[__i__][title]" placeholder="Title" class="{{ $inputClass }}">
                        </div>
                        <textarea name="timeline[__i__][description]" rows="2" placeholder="Description" class="{{ $inputClass }} mt-3"></textarea>
                        <div class="mt-2 text-right">
                            <button type="button" data-repeater-remove class="text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                        </div>
                    </div>
                </template>
                <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Add milestone
                </button>
            </div>
        </section>

        {{-- ===================== 4. FOUNDER ===================== --}}
        <section data-panel="founder" class="hidden rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Founder</h2>
            <p class="mt-1 text-sm text-stone-500">The "Meet Our Founder" section. If no photo is set, a designed initials placeholder is shown.</p>

            <div class="mt-5 space-y-5">
                <div class="grid gap-5 sm:grid-cols-2">
                    <x-form.input name="founder[name]" label="Name" :value="$about['founder']['name'] ?? ''" />
                    <x-form.input name="founder[title]" label="Title" :value="$about['founder']['title'] ?? ''" />
                </div>

                <x-form.file name="founder_photo" label="Photo" :current="$founderPhoto" />

                <x-form.textarea name="founder[bio1]" label="Bio paragraph 1" rows="3" :value="$about['founder']['bio1'] ?? ''" />
                <x-form.textarea name="founder[bio2]" label="Bio paragraph 2" rows="3" :value="$about['founder']['bio2'] ?? ''" />
                <x-form.textarea name="founder[quote]" label="Quote" rows="2" :value="$about['founder']['quote'] ?? ''" hint="Shown in the highlighted quote block (no quotation marks needed)." />

                {{-- Founder stats --}}
                <div>
                    <label class="block text-sm font-medium text-brand-900">Mini stats</label>
                    <p class="mt-1 text-xs text-stone-400">The three small stat boxes. Empty rows are ignored.</p>
                    <div data-repeater data-next="{{ count($stats) }}" class="mt-3">
                        <div data-repeater-items class="space-y-3">
                            @foreach ($stats as $i => $s)
                                <div data-repeater-row class="flex items-center gap-3">
                                    <input type="text" name="founder[stats][{{ $i }}][v]" value="{{ $s['v'] ?? '' }}" placeholder="Value (e.g. 10+)" class="{{ $inputClass }}">
                                    <input type="text" name="founder[stats][{{ $i }}][l]" value="{{ $s['l'] ?? '' }}" placeholder="Label (e.g. Years Leading)" class="{{ $inputClass }}">
                                    <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <template data-repeater-template>
                            <div data-repeater-row class="flex items-center gap-3">
                                <input type="text" name="founder[stats][__i__][v]" placeholder="Value (e.g. 10+)" class="{{ $inputClass }}">
                                <input type="text" name="founder[stats][__i__][l]" placeholder="Label (e.g. Years Leading)" class="{{ $inputClass }}">
                                <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                            </div>
                        </template>
                        <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Add stat
                        </button>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===================== 5. WHY CHOOSE US (values) ===================== --}}
        <section data-panel="values" class="hidden rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Why Choose Us</h2>
            <p class="mt-1 text-sm text-stone-500">The four value cards. Rows with an empty title are ignored. <span class="text-stone-400">Icon = SVG path <code>d</code>.</span></p>

            <div data-repeater data-next="{{ count($values) }}" class="mt-5">
                <div data-repeater-items class="space-y-3">
                    @foreach ($values as $i => $v)
                        <div data-repeater-row class="rounded-xl border border-stone-200 bg-stone-50/60 p-4">
                            <input type="text" name="values[{{ $i }}][title]" value="{{ $v['title'] ?? '' }}" placeholder="Title" class="{{ $inputClass }}">
                            <textarea name="values[{{ $i }}][description]" rows="2" placeholder="Description" class="{{ $inputClass }} mt-3">{{ $v['description'] ?? '' }}</textarea>
                            <input type="text" name="values[{{ $i }}][icon]" value="{{ $v['icon'] ?? '' }}" placeholder="Icon SVG path (d)" class="{{ $inputClass }} mt-3">
                            <div class="mt-2 text-right">
                                <button type="button" data-repeater-remove class="text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <template data-repeater-template>
                    <div data-repeater-row class="rounded-xl border border-stone-200 bg-stone-50/60 p-4">
                        <input type="text" name="values[__i__][title]" placeholder="Title" class="{{ $inputClass }}">
                        <textarea name="values[__i__][description]" rows="2" placeholder="Description" class="{{ $inputClass }} mt-3"></textarea>
                        <input type="text" name="values[__i__][icon]" placeholder="Icon SVG path (d)" class="{{ $inputClass }} mt-3">
                        <div class="mt-2 text-right">
                            <button type="button" data-repeater-remove class="text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                        </div>
                    </div>
                </template>
                <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Add value
                </button>
            </div>
        </section>

        {{-- ===================== 6. CALL TO ACTION ===================== --}}
        <section data-panel="cta" class="hidden rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Call to action</h2>
            <p class="mt-1 text-sm text-stone-500">The closing banner. Buttons with an empty label are ignored.</p>

            <div class="mt-5 space-y-5">
                <x-form.input name="cta[tagline]" label="Tagline" :value="$about['cta']['tagline'] ?? ''" hint="The small script line above the headline." />
                <x-form.input name="cta[headline]" label="Headline" :value="$about['cta']['headline'] ?? ''" />
                <x-form.textarea name="cta[subtitle]" label="Subtitle" rows="2" :value="$about['cta']['subtitle'] ?? ''" />

                <div>
                    <label class="block text-sm font-medium text-brand-900">Buttons</label>
                    <p class="mt-1 text-xs text-stone-400">Use full links (tel:, https://…) or a #fragment for the homepage. Empty rows are ignored.</p>
                    <div data-repeater data-next="{{ count($buttons) }}" class="mt-3">
                        <div data-repeater-items class="space-y-3">
                            @foreach ($buttons as $i => $b)
                                <div data-repeater-row class="flex flex-col gap-3 rounded-xl border border-stone-200 bg-stone-50/60 p-4 sm:flex-row sm:items-center">
                                    <input type="text" name="cta[buttons][{{ $i }}][label]" value="{{ $b['label'] ?? '' }}" placeholder="Label" class="{{ $inputClass }}">
                                    <input type="text" name="cta[buttons][{{ $i }}][href]" value="{{ $b['href'] ?? '' }}" placeholder="Link or #fragment" class="{{ $inputClass }}">
                                    <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <template data-repeater-template>
                            <div data-repeater-row class="flex flex-col gap-3 rounded-xl border border-stone-200 bg-stone-50/60 p-4 sm:flex-row sm:items-center">
                                <input type="text" name="cta[buttons][__i__][label]" placeholder="Label" class="{{ $inputClass }}">
                                <input type="text" name="cta[buttons][__i__][href]" placeholder="Link or #fragment" class="{{ $inputClass }}">
                                <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                            </div>
                        </template>
                        <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Add button
                        </button>
                    </div>
                </div>
            </div>
        </section>

        </div>{{-- /data-tabs --}}

        {{-- Save --}}
        <div class="flex justify-end">
            <button type="submit" class="rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md focus:outline-none focus:ring-2 focus:ring-brand-500/40">
                Save About page
            </button>
        </div>
    </form>
@endsection
