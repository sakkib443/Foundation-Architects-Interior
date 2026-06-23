@extends('layouts.admin')

@section('title', 'Footer & Nav')
@section('heading', 'Footer & Navigation')

@php
    $links = old('links', $footer['links'] ?? []);
    $links = is_array($links) ? array_values($links) : [];

    $inputClass = 'block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30';
@endphp

@section('content')
    <p class="text-sm text-stone-500">The about blurb and quick links in the site footer, plus the call-to-action button in the top navigation bar.</p>

    <form method="POST" action="{{ route('admin.site-content.footer.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- Footer about --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Footer about</h2>
            <p class="mt-1 text-sm text-stone-500">The short paragraph shown beside the logo in the footer.</p>

            <div class="mt-5">
                <x-form.textarea name="about" label="About text" rows="3" :value="$footer['about'] ?? ''" />
            </div>
        </section>

        {{-- Footer links --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Footer links</h2>
            <p class="mt-1 text-sm text-stone-500">Quick navigation links. Rows with an empty label are ignored.</p>

            <div data-repeater data-next="{{ count($links) }}" class="mt-5">
                <div data-repeater-items class="space-y-3">
                    @foreach ($links as $i => $link)
                        <div data-repeater-row class="flex flex-col gap-3 rounded-xl border border-stone-200 bg-stone-50/60 p-4 sm:flex-row sm:items-center">
                            <input type="text" name="links[{{ $i }}][label]" value="{{ $link['label'] ?? '' }}" placeholder="Label (e.g. About Us)" class="{{ $inputClass }}">
                            <input type="text" name="links[{{ $i }}][href]" value="{{ $link['href'] ?? '' }}" placeholder="Link (e.g. /about)" class="{{ $inputClass }}">
                            <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                        </div>
                    @endforeach
                </div>

                <template data-repeater-template>
                    <div data-repeater-row class="flex flex-col gap-3 rounded-xl border border-stone-200 bg-stone-50/60 p-4 sm:flex-row sm:items-center">
                        <input type="text" name="links[__i__][label]" placeholder="Label (e.g. About Us)" class="{{ $inputClass }}">
                        <input type="text" name="links[__i__][href]" placeholder="Link (e.g. /about)" class="{{ $inputClass }}">
                        <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                    </div>
                </template>

                <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Add link
                </button>
            </div>
        </section>

        {{-- Nav CTA --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Navbar button</h2>
            <p class="mt-1 text-sm text-stone-500">The highlighted call-to-action button in the top navigation bar.</p>

            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                <x-form.input name="nav_cta[label]" label="Button label" :value="$nav['cta']['label'] ?? ''" placeholder="Cost Calculator" />
                <x-form.input name="nav_cta[href]" label="Button link" :value="$nav['cta']['href'] ?? ''" placeholder="#cost-calculator" />
            </div>
        </section>

        {{-- Save --}}
        <div class="flex justify-end">
            <button type="submit" class="rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md focus:outline-none focus:ring-2 focus:ring-brand-500/40">
                Save footer &amp; nav
            </button>
        </div>
    </form>
@endsection
