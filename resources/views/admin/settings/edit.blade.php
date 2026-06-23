@extends('layouts.admin')

@section('title', 'Settings')
@section('heading', 'Settings')

@section('content')
    <p class="text-sm text-stone-500">Global site identity, theme colours, fonts, social links and contact details. These power the public site header, footer and SEO.</p>

    @php
        // Shared input class (mirrors the x-form.input component) so the raw
        // bracket-named inputs below match the brand styling exactly.
        $fieldClass = 'mt-2 block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30';
        $labelClass = 'block text-sm font-medium text-brand-900';
        $hintClass  = 'mt-1 text-xs text-stone-400';
    @endphp

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- 1. Site identity --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Site identity</h2>
            <p class="mt-1 text-sm text-stone-500">Name, logo, favicon and the default search-engine description.</p>

            <div class="mt-5 space-y-5">
                <x-form.input
                    name="name"
                    label="Site name"
                    :value="$site['name'] ?? ''"
                    required
                />

                <div class="grid gap-5 sm:grid-cols-2">
                    <x-form.file
                        name="logo"
                        label="Logo"
                        :current="$site['logo'] ?? null"
                    />
                    <x-form.file
                        name="favicon"
                        label="Favicon"
                        :current="$site['favicon'] ?? null"
                    />
                </div>

                <x-form.textarea
                    name="seo_description"
                    label="Default SEO description"
                    :value="$site['seo']['description'] ?? ''"
                    rows="3"
                    hint="Used as the fallback meta description across the site."
                />
            </div>
        </section>

        {{-- 2. Brand colours --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Brand colours</h2>
            <p class="mt-1 text-sm text-stone-500">The 50&ndash;900 palette that themes the whole site. Pick a colour for each shade.</p>

            <div class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-5">
                @php
                    $shades = ['50', '100', '200', '300', '400', '500', '600', '700', '800', '900'];
                    $shadeDefaults = [
                        '50' => '#eff6ff', '100' => '#dbeafe', '200' => '#bfdbfe', '300' => '#93c5fd',
                        '400' => '#60a5fa', '500' => '#3b82f6', '600' => '#2563eb', '700' => '#1d4ed8',
                        '800' => '#1e40af', '900' => '#1e3a8a',
                    ];
                @endphp
                @foreach ($shades as $shade)
                    @php
                        $colorValue = old('brand_colors.'.$shade, $site['brand_colors'][$shade] ?? $shadeDefaults[$shade]);
                    @endphp
                    <div>
                        <label for="brand_colors_{{ $shade }}" class="block text-xs font-semibold text-brand-900">{{ $shade }}</label>
                        <div class="mt-1.5 flex items-center gap-2">
                            <input
                                type="color"
                                name="brand_colors[{{ $shade }}]"
                                id="brand_colors_{{ $shade }}"
                                value="{{ $colorValue }}"
                                class="h-10 w-10 shrink-0 cursor-pointer rounded-lg border border-stone-200 bg-white p-1 shadow-sm"
                            >
                            <span class="truncate text-xs font-medium uppercase tracking-wide text-stone-500">{{ $colorValue }}</span>
                        </div>
                        @error('brand_colors.'.$shade)<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                    </div>
                @endforeach
            </div>
        </section>

        {{-- 3. Fonts --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Fonts</h2>
            <p class="mt-1 text-sm text-stone-500">Advanced &mdash; font family names used by the site theme.</p>

            <div class="mt-5 grid gap-5 sm:grid-cols-3">
                @php
                    $fontFields = [
                        'display' => ['Display font', 'Headings (advanced).'],
                        'script'  => ['Script font', 'Accent / script (advanced).'],
                        'sans'    => ['Sans font', 'Body text (advanced).'],
                    ];
                @endphp
                @foreach ($fontFields as $key => [$label, $hint])
                    <div>
                        <label for="fonts_{{ $key }}" class="{{ $labelClass }}">{{ $label }}</label>
                        <input type="text" name="fonts[{{ $key }}]" id="fonts_{{ $key }}"
                            value="{{ old('fonts.'.$key, $site['fonts'][$key] ?? '') }}"
                            class="{{ $fieldClass }}">
                        <p class="{{ $hintClass }}">{{ $hint }}</p>
                        @error('fonts.'.$key)<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                    </div>
                @endforeach
            </div>
        </section>

        {{-- 4. Social links --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Social links</h2>
            <p class="mt-1 text-sm text-stone-500">Full profile URLs. Leave blank to hide a network.</p>

            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                @php
                    $socialFields = [
                        'facebook'  => ['Facebook', 'https://facebook.com/…'],
                        'instagram' => ['Instagram', 'https://instagram.com/…'],
                        'linkedin'  => ['LinkedIn', 'https://linkedin.com/…'],
                        'youtube'   => ['YouTube', 'https://youtube.com/…'],
                    ];
                @endphp
                @foreach ($socialFields as $key => [$label, $placeholder])
                    <div>
                        <label for="social_{{ $key }}" class="{{ $labelClass }}">{{ $label }}</label>
                        <input type="url" name="social[{{ $key }}]" id="social_{{ $key }}"
                            value="{{ old('social.'.$key, $site['social'][$key] ?? '') }}"
                            placeholder="{{ $placeholder }}"
                            class="{{ $fieldClass }}">
                        @error('social.'.$key)<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                    </div>
                @endforeach
            </div>
        </section>

        {{-- 5. Global contact --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Global contact</h2>
            <p class="mt-1 text-sm text-stone-500">Shown in the footer and contact areas. Display variants are what visitors see; the others are used for links (tel:, wa.me).</p>

            <div class="mt-5 space-y-5">
                <div>
                    <label for="contact_address" class="{{ $labelClass }}">Address</label>
                    <input type="text" name="contact[address]" id="contact_address"
                        value="{{ old('contact.address', $site['contact']['address'] ?? '') }}"
                        class="{{ $fieldClass }}">
                    @error('contact.address')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    @php
                        $contactFields = [
                            'phone'            => ['Phone (link)', 'text', 'Used for tel: links, e.g. +8801722752657'],
                            'phone_display'    => ['Phone (display)', 'text', 'Shown to visitors, e.g. 01722-752657'],
                            'whatsapp'         => ['WhatsApp (number)', 'text', 'Digits only for wa.me, e.g. 8801722752657'],
                            'whatsapp_display' => ['WhatsApp (display)', 'text', null],
                            'email'            => ['Email', 'email', null],
                        ];
                    @endphp
                    @foreach ($contactFields as $key => [$label, $type, $hint])
                        <div>
                            <label for="contact_{{ $key }}" class="{{ $labelClass }}">{{ $label }}</label>
                            <input type="{{ $type }}" name="contact[{{ $key }}]" id="contact_{{ $key }}"
                                value="{{ old('contact.'.$key, $site['contact'][$key] ?? '') }}"
                                class="{{ $fieldClass }}">
                            @if ($hint)<p class="{{ $hintClass }}">{{ $hint }}</p>@endif
                            @error('contact.'.$key)<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Save --}}
        <div class="flex justify-end">
            <button type="submit" class="rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md focus:outline-none focus:ring-2 focus:ring-brand-500/40">
                Save settings
            </button>
        </div>
    </form>
@endsection
