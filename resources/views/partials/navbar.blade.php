@php
    $navLinks = [
        ['label' => 'Home', 'href' => route('home')],
        ['label' => 'About Us', 'href' => route('about')],
        ['label' => 'Projects', 'href' => route('home') . '#projects'],
        ['label' => 'Testimonials', 'href' => route('home') . '#testimonials'],
        ['label' => 'Blog', 'href' => route('home') . '#blog'],
        ['label' => 'Contact', 'href' => route('home') . '#contact'],
    ];
    $services = ['Residential Design', 'Commercial Interior', 'Modular Kitchen', '3D Visualization', 'Turnkey Projects'];
@endphp

<header id="site-header" class="fixed inset-x-0 top-0 z-50">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo.svg') }}" alt="Foundation Architects &amp; Interior"
                 width="48" height="48"
                 class="h-12 w-12 rounded-full shadow-lg ring-1 ring-white/20">
            <span class="leading-tight">
                <span class="brand-name block font-script text-3xl leading-none">Foundation</span>
                <span class="brand-sub block text-[10px] font-semibold uppercase tracking-[0.25em]">Architects &amp; Interior</span>
            </span>
        </a>

        {{-- Desktop nav --}}
        <nav class="hidden items-center gap-6 xl:flex">
            @foreach ($navLinks as $i => $link)
                @if ($i === 1)
                    {{-- Services dropdown after "About Us" --}}
                    <div class="group relative">
                        <button class="nav-link flex items-center gap-1 font-display text-[15px] font-medium tracking-wide">
                            Services
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="invisible absolute left-1/2 top-full z-50 w-56 -translate-x-1/2 translate-y-2 rounded-xl border border-stone-100 bg-white p-2 opacity-0 shadow-xl transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                            @foreach ($services as $service)
                                <a href="{{ route('home') }}#services" class="block rounded-lg px-4 py-2 font-display text-sm text-stone-600 transition hover:bg-brand-50 hover:text-brand-700">{{ $service }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <a href="{{ $link['href'] }}" class="nav-link font-display text-[15px] font-medium tracking-wide">{{ $link['label'] }}</a>
            @endforeach
        </nav>

        {{-- CTA + mobile toggle --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}#cost-calculator"
               class="hidden items-center gap-2 rounded-full bg-gradient-to-r from-brand-400 to-brand-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:from-brand-500 hover:to-brand-700 xl:inline-flex">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="4" y="2" width="16" height="20" rx="2"/>
                    <path stroke-linecap="round" d="M8 6h8M8 10h2m4 0h2M8 14h2m4 0h2M8 18h2m4 0h2"/>
                </svg>
                Cost Calculator
            </a>

            <button id="menu-toggle" class="nav-link xl:hidden" aria-label="Toggle menu">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="hidden border-t border-stone-100 bg-white px-4 py-4 shadow-lg xl:hidden">
        <div class="flex flex-col gap-1">
            <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Home</a>
            <a href="{{ route('about') }}" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">About Us</a>
            <a href="{{ route('home') }}#services" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Services</a>
            <a href="{{ route('home') }}#projects" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Projects</a>
            <a href="{{ route('home') }}#testimonials" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Testimonials</a>
            <a href="{{ route('home') }}#blog" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Blog</a>
            <a href="{{ route('home') }}#contact" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Contact</a>
            <a href="{{ route('home') }}#cost-calculator" class="mt-2 rounded-full bg-gradient-to-r from-brand-400 to-brand-600 px-5 py-2.5 text-center text-sm font-semibold text-white">Cost Calculator</a>
        </div>
    </div>
</header>
