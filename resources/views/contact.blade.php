@extends('layouts.app')

@section('title', 'Contact — ' . config('app.name'))
@section('meta_description', 'Get in touch with Foundation Architects & Interior — visit our studio in Mohammadpur, Dhaka, or reach us by phone, WhatsApp, or email to start your next project.')

@php
    $contactCards = $settings->get('contact.cards', []);
    $contactCards = (is_array($contactCards) && ! empty($contactCards)) ? $contactCards : [
        [
            'label' => 'Visit our studio',
            'value' => 'House-27, Road-12, Shekertak, Mohammadpur, Dhaka',
            'href'  => 'https://maps.google.com/?q=Mohammadpur+Dhaka',
            'icon'  => 'M12 11.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M19.5 9.5c0 6.5-7.5 12-7.5 12s-7.5-5.5-7.5-12a7.5 7.5 0 0115 0z',
        ],
        [
            'label' => 'Call us',
            'value' => '+880 1722-752657',
            'href'  => 'tel:+8801722752657',
            'icon'  => 'M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.515l.86 3.44a2 2 0 01-.45 1.95L8.21 11.29a11 11 0 004.5 4.5l1.385-1.42a2 2 0 011.95-.45l3.44.86A2 2 0 0121 16.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
        ],
        [
            'label' => 'WhatsApp',
            'value' => $settings->get('site.contact.whatsapp_display') ?: $settings->get('site.contact.whatsapp', '+880 1722-752657'),
            'href'  => 'https://wa.me/' . preg_replace('/\D+/', '', (string) $settings->get('site.contact.whatsapp', '8801722752657')),
            'icon'  => 'M20.52 3.48A11.93 11.93 0 0012 0C5.37 0 0 5.37 0 12c0 2.12.55 4.16 1.6 5.97L0 24l6.18-1.62A11.94 11.94 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22a9.94 9.94 0 01-5.07-1.39l-.36-.21-3.67.96.98-3.58-.23-.37A9.95 9.95 0 1122 12c0 5.52-4.48 10-10 10z',
        ],
        [
            'label' => 'Email us',
            'value' => 'f.architects2016@gmail.com',
            'href'  => 'mailto:f.architects2016@gmail.com',
            'icon'  => 'M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm0 2v.01L12 13l8-6.99V6H4zm16 2.236L12 15l-8-6.764V18h16V8.236z',
        ],
    ];

    $contactHours = $settings->get('contact.hours', []);
    $contactHours = is_array($contactHours) ? $contactHours : [];
    $hoursDays   = $contactHours['days'] ?? 'Saturday — Thursday';
    $hoursTime   = $contactHours['time'] ?? '10:00 AM — 7:00 PM';
    $hoursClosed = $contactHours['closed'] ?? 'Closed on Fridays';

    $contactSubjects = $settings->get('contact.subjects', []);
    $contactSubjects = (is_array($contactSubjects) && ! empty($contactSubjects)) ? $contactSubjects : [
        'Residential Design',
        'Commercial Interior',
        'Modular Kitchen',
        '3D Visualization',
        'Turnkey Project',
        'Other',
    ];
@endphp

@section('content')

    {{-- ======================= PAGE HERO ======================= --}}
    @include('partials.page-hero', array_merge([
        'image'    => 'images/hero/slide-2.jpg',
        'eyebrow'  => 'Say Hello',
        'title'    => "Let's Design Your Space",
        'subtitle' => "Have a project in mind or just a question? We'd love to hear from you. Reach out below and our team will get back within one working day.",
    ], $settings->get('page_heroes.contact', []), ['crumb' => 'Contact']))

    {{-- ======================= CONTACT INFO + FORM ======================= --}}
    <section class="bg-brand-50 py-20 sm:py-28">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-5 lg:gap-12 lg:px-8">

            {{-- Left: contact info cards --}}
            <div class="lg:col-span-2">
                <p class="section-eyebrow text-brand-600">Get in touch</p>
                <h2 class="mt-2 font-display text-3xl font-bold tracking-tight text-brand-900 sm:text-4xl">
                    Talk to our team
                </h2>
                <p class="mt-4 max-w-md text-stone-500">
                    Whether you're planning a new home, a café, or a complete office fit-out — we're here to listen.
                </p>

                <div class="mt-8 space-y-4">
                    @foreach ($contactCards as $card)
                        <a href="{{ $card['href'] }}"
                           class="group flex items-start gap-4 rounded-2xl border border-stone-100 bg-white p-5 shadow-sm ring-1 ring-stone-900/5 transition hover:-translate-y-0.5 hover:shadow-md hover:shadow-stone-900/10">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-brand-400 to-brand-600 text-white shadow-sm">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/>
                                </svg>
                            </span>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold uppercase tracking-wider text-brand-600">{{ $card['label'] }}</p>
                                <p class="mt-1 break-words text-sm font-medium text-stone-700 transition group-hover:text-brand-800">
                                    {{ $card['value'] }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Office hours --}}
                <div class="mt-8 rounded-2xl border border-brand-100 bg-brand-100/40 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wider text-brand-700">Office hours</p>
                    <p class="mt-1 text-sm text-stone-700">{{ $hoursDays }} · {{ $hoursTime }}</p>
                    <p class="text-sm text-stone-500">{{ $hoursClosed }}</p>
                </div>
            </div>

            {{-- Right: form --}}
            <div class="lg:col-span-3">
                <form action="{{ route('contact.submit') }}" method="POST"
                      class="rounded-3xl border border-stone-100 bg-white p-7 shadow-xl shadow-stone-900/5 ring-1 ring-stone-900/5 sm:p-10">
                    @csrf

                    <h3 class="font-display text-2xl font-bold text-brand-900 sm:text-3xl">Send a message</h3>
                    <p class="mt-2 text-sm text-stone-500">Fill in the form and we'll respond within one working day.</p>

                    @if (session('contact_status'))
                        <div class="mt-5 flex items-start gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                            <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ session('contact_status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mt-5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                            Please correct the highlighted fields and try again.
                        </div>
                    @endif

                    <div class="mt-7 grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-brand-900">Full name</label>
                            <input type="text" id="name" name="name" required autocomplete="name"
                                   placeholder="Your name" value="{{ old('name') }}"
                                   class="mt-2 block w-full rounded-xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-brand-900">Email</label>
                            <input type="email" id="email" name="email" required autocomplete="email"
                                   placeholder="you@example.com" value="{{ old('email') }}"
                                   class="mt-2 block w-full rounded-xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-brand-900">Phone (optional)</label>
                            <input type="tel" id="phone" name="phone" autocomplete="tel"
                                   placeholder="+880 1XXX-XXXXXX" value="{{ old('phone') }}"
                                   class="mt-2 block w-full rounded-xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-brand-900">Subject</label>
                            <select id="subject" name="subject"
                                    class="mt-2 block w-full rounded-xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-800 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                                @foreach ($contactSubjects as $subject)
                                    <option @selected(old('subject') === $subject)>{{ $subject }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="message" class="block text-sm font-medium text-brand-900">Your message</label>
                        <textarea id="message" name="message" rows="5" required
                                  placeholder="Tell us a little about your space and what you have in mind…"
                                  class="mt-2 block w-full resize-none rounded-xl border border-stone-200 bg-white px-4 py-3 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">{{ old('message') }}</textarea>
                    </div>

                    <div class="mt-7 flex flex-col-reverse items-stretch gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs text-stone-500">We respect your privacy. Your details are never shared.</p>
                        <button type="submit"
                                class="group inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-brand-400 to-brand-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:from-brand-500 hover:to-brand-700">
                            Send message
                            <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
