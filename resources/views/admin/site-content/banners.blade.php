@extends('layouts.admin')

@section('title', 'Page Banners')
@section('heading', 'Page Banners')

@php
    $pages = [
        'about'        => 'About',
        'services'     => 'Services',
        'projects'     => 'Projects',
        'blog'         => 'Blog',
        'testimonials' => 'Testimonials',
        'contact'      => 'Contact',
    ];
@endphp

@section('content')
    <p class="text-sm text-stone-500">Edit the top banner — background image, script line, title and subtitle — for each inner page. Changes go live immediately.</p>

    <form method="POST" action="{{ route('admin.site-content.banners.update') }}" enctype="multipart/form-data" class="mt-6">
        @csrf
        @method('PUT')

        <div data-tabs>
            {{-- Tab nav --}}
            <nav class="mb-6 flex flex-wrap gap-1 overflow-x-auto border-b border-stone-200">
                @foreach ($pages as $key => $label)
                    <button type="button" data-tab="{{ $key }}" class="-mb-px whitespace-nowrap border-b-2 px-4 py-2.5 text-sm font-semibold transition {{ $loop->first ? 'border-brand-600 text-brand-700' : 'border-transparent text-stone-500 hover:text-brand-700' }}">{{ $label }}</button>
                @endforeach
            </nav>

            @foreach ($pages as $key => $label)
                @php $h = $heroes[$key] ?? []; @endphp
                <section data-panel="{{ $key }}" class="{{ $loop->first ? '' : 'hidden ' }}rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
                    <h2 class="font-display text-lg font-bold text-brand-900">{{ $label }} page banner</h2>

                    <div class="mt-5 space-y-5">
                        {{-- Background image --}}
                        <div>
                            <label class="block text-sm font-medium text-brand-900">Background image</label>
                            <input type="hidden" name="heroes[{{ $key }}][image]" value="{{ $h['image'] ?? '' }}">
                            <div class="mt-2 flex items-center gap-4">
                                @if (!empty($h['image']))
                                    <img src="{{ asset($h['image']) }}" alt="" class="h-20 w-32 rounded-lg object-cover ring-1 ring-stone-200">
                                @endif
                                <img id="image_{{ $key }}-preview" alt="" class="hidden h-20 w-32 rounded-lg object-cover ring-1 ring-brand-300">
                                <input type="file" name="image_{{ $key }}" accept="image/*" data-preview="#image_{{ $key }}-preview"
                                       class="block w-full text-sm text-stone-500 file:mr-4 file:rounded-full file:border-0 file:bg-brand-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-700 hover:file:bg-brand-100">
                            </div>
                            <p class="mt-1 text-xs text-stone-400">Leave empty to keep the current image.</p>
                        </div>

                        <x-form.input name="heroes[{{ $key }}][eyebrow]" label="Eyebrow (script line)" :value="$h['eyebrow'] ?? ''" />
                        <x-form.input name="heroes[{{ $key }}][title]" label="Title" :value="$h['title'] ?? ''" />
                        <x-form.textarea name="heroes[{{ $key }}][subtitle]" label="Subtitle" rows="2" :value="$h['subtitle'] ?? ''" />
                    </div>
                </section>
            @endforeach
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md focus:outline-none focus:ring-2 focus:ring-brand-500/40">
                Save banners
            </button>
        </div>
    </form>
@endsection
