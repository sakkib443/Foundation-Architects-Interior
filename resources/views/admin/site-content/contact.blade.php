@extends('layouts.admin')

@section('title', 'Contact Page')
@section('heading', 'Contact Page')

@php
    $cards = old('cards', $contact['cards'] ?? []);
    $cards = is_array($cards) ? array_values($cards) : [];

    $subjects = old('subjects', $contact['subjects'] ?? []);
    $subjects = is_array($subjects) ? array_values($subjects) : [];

    $inputClass = 'block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30';
@endphp

@section('content')
    <p class="text-sm text-stone-500">The information cards, office hours and enquiry-form subjects shown on the public <a href="{{ route('contact') }}" target="_blank" class="font-medium text-brand-600 hover:text-brand-800">Contact page</a>.</p>

    <form method="POST" action="{{ route('admin.site-content.contact.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- Contact cards --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Contact cards</h2>
            <p class="mt-1 text-sm text-stone-500">The clickable info cards (address, phone, WhatsApp, email). Rows with an empty label are ignored. <span class="text-stone-400">Icon = the SVG path <code>d</code> value.</span></p>

            <div data-repeater data-next="{{ count($cards) }}" class="mt-5">
                <div data-repeater-items class="space-y-3">
                    @foreach ($cards as $i => $card)
                        <div data-repeater-row class="rounded-xl border border-stone-200 bg-stone-50/60 p-4">
                            <div class="grid gap-3 sm:grid-cols-2">
                                <input type="text" name="cards[{{ $i }}][label]" value="{{ $card['label'] ?? '' }}" placeholder="Label (e.g. Call us)" class="{{ $inputClass }}">
                                <input type="text" name="cards[{{ $i }}][value]" value="{{ $card['value'] ?? '' }}" placeholder="Value (e.g. +880 1722-752657)" class="{{ $inputClass }}">
                                <input type="text" name="cards[{{ $i }}][href]" value="{{ $card['href'] ?? '' }}" placeholder="Link (tel:, mailto:, https://…)" class="{{ $inputClass }}">
                                <input type="text" name="cards[{{ $i }}][icon]" value="{{ $card['icon'] ?? '' }}" placeholder="Icon SVG path (d)" class="{{ $inputClass }}">
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
                            <input type="text" name="cards[__i__][label]" placeholder="Label (e.g. Call us)" class="{{ $inputClass }}">
                            <input type="text" name="cards[__i__][value]" placeholder="Value (e.g. +880 1722-752657)" class="{{ $inputClass }}">
                            <input type="text" name="cards[__i__][href]" placeholder="Link (tel:, mailto:, https://…)" class="{{ $inputClass }}">
                            <input type="text" name="cards[__i__][icon]" placeholder="Icon SVG path (d)" class="{{ $inputClass }}">
                        </div>
                        <div class="mt-2 text-right">
                            <button type="button" data-repeater-remove class="text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                        </div>
                    </div>
                </template>

                <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Add card
                </button>
            </div>
        </section>

        {{-- Office hours --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Office hours</h2>
            <p class="mt-1 text-sm text-stone-500">Shown in the highlighted box under the contact cards.</p>

            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                <x-form.input name="hours[days]" label="Open days" :value="$contact['hours']['days'] ?? ''" placeholder="Saturday — Thursday" />
                <x-form.input name="hours[time]" label="Open time" :value="$contact['hours']['time'] ?? ''" placeholder="10:00 AM — 7:00 PM" />
                <x-form.input name="hours[closed]" label="Closed note" :value="$contact['hours']['closed'] ?? ''" placeholder="Closed on Fridays" />
            </div>
        </section>

        {{-- Form subjects --}}
        <section class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
            <h2 class="font-display text-lg font-bold text-brand-900">Enquiry subjects</h2>
            <p class="mt-1 text-sm text-stone-500">The options in the contact form's "Subject" dropdown. Empty rows are ignored.</p>

            <div data-repeater data-next="{{ count($subjects) }}" class="mt-5">
                <div data-repeater-items class="space-y-3">
                    @foreach ($subjects as $i => $subject)
                        <div data-repeater-row class="flex items-center gap-3">
                            <input type="text" name="subjects[{{ $i }}]" value="{{ $subject }}" placeholder="Subject option" class="{{ $inputClass }}">
                            <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                        </div>
                    @endforeach
                </div>

                <template data-repeater-template>
                    <div data-repeater-row class="flex items-center gap-3">
                        <input type="text" name="subjects[__i__]" placeholder="Subject option" class="{{ $inputClass }}">
                        <button type="button" data-repeater-remove class="shrink-0 text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                    </div>
                </template>

                <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Add subject
                </button>
            </div>
        </section>

        {{-- Save --}}
        <div class="flex justify-end">
            <button type="submit" class="rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md focus:outline-none focus:ring-2 focus:ring-brand-500/40">
                Save contact page
            </button>
        </div>
    </form>
@endsection
