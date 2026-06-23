@extends('layouts.admin')

@section('title', 'Site Content')
@section('heading', 'Site Content')

@section('content')
    <p class="text-sm text-stone-500">Edit the content that appears across the public site — the About page sections, the Contact page, and the footer &amp; navigation.</p>

    @php
        $cards = [
            [
                'label' => 'About Page',
                'desc'  => 'Story, vision &amp; mission, timeline, founder, why-choose-us and the call-to-action.',
                'href'  => route('admin.site-content.about.edit'),
                'icon'  => 'M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z',
                'color' => 'from-blue-500 to-blue-600',
            ],
            [
                'label' => 'Contact Page',
                'desc'  => 'Contact cards, office hours and the enquiry-form subjects.',
                'href'  => route('admin.site-content.contact.edit'),
                'icon'  => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75',
                'color' => 'from-indigo-500 to-indigo-600',
            ],
            [
                'label' => 'Footer &amp; Nav',
                'desc'  => 'Footer about text, footer links and the navbar call-to-action button.',
                'href'  => route('admin.site-content.footer.edit'),
                'icon'  => 'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25z',
                'color' => 'from-sky-500 to-sky-600',
            ],
        ];
    @endphp

    <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($cards as $c)
            <a href="{{ $c['href'] }}" class="group rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br {{ $c['color'] }} text-white shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $c['icon'] }}"/></svg>
                </div>
                <h2 class="mt-4 font-display text-lg font-bold text-brand-900">{!! $c['label'] !!}</h2>
                <p class="mt-1 text-sm leading-relaxed text-stone-500">{!! $c['desc'] !!}</p>
                <p class="mt-3 text-xs font-semibold text-brand-600 opacity-0 transition group-hover:opacity-100">Open editor &rarr;</p>
            </a>
        @endforeach
    </div>
@endsection
