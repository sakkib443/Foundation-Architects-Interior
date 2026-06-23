@php
    $navLinks = [
        ['label' => 'Home', 'href' => route('home')],
        ['label' => 'About Us', 'href' => route('about')],
        ['label' => 'Projects', 'href' => route('projects')],
        ['label' => 'Testimonials', 'href' => route('testimonials')],
        ['label' => 'Blog', 'href' => route('blog')],
        ['label' => 'Contact', 'href' => route('contact')],
    ];
    $services = \App\Models\Service::where('is_published', true)->orderBy('sort_order')->get();
    $navCta = $settings->get('nav.cta', ['label' => 'Cost Calculator', 'href' => '#cost-calculator']);
@endphp

<header id="site-header" class="fixed inset-x-0 top-0 z-50">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset($settings->get('site.logo', 'images/logo.svg')) }}" alt="{{ $settings->get('site.name', 'Foundation Architects & Interior') }}"
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
                        <a href="{{ route('services') }}" class="nav-link flex items-center gap-1 font-display text-[15px] font-medium tracking-wide">
                            Services
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                        <div class="invisible absolute left-1/2 top-full z-50 w-56 -translate-x-1/2 translate-y-2 rounded-xl border border-stone-100 bg-white p-2 opacity-0 shadow-xl transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                            @foreach ($services as $service)
                                <a href="{{ route('services.show', $service->slug) }}" class="block rounded-lg px-4 py-2 font-display text-sm text-stone-600 transition hover:bg-brand-50 hover:text-brand-700">{{ $service->title }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <a href="{{ $link['href'] }}" class="nav-link font-display text-[15px] font-medium tracking-wide">{{ $link['label'] }}</a>
            @endforeach
        </nav>

        {{-- CTA + mobile toggle --}}
        <div class="flex items-center gap-3">
            <a href="{{ $navCta['href'] ?? '/services' }}"
               class="cta-shine hidden items-center gap-2 rounded-full bg-gradient-to-r from-brand-400 via-brand-500 to-brand-700 px-5 py-2.5 text-sm font-semibold text-white xl:inline-flex">
                <svg class="cta-icon h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25a2.25 2.25 0 01-2.25-2.25v-2.25z"/>
                </svg>
                {{ $navCta['label'] ?? 'Our Services' }}
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
            <a href="{{ route('services') }}" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Services</a>
            <a href="{{ route('projects') }}" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Projects</a>
            <a href="{{ route('testimonials') }}" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Testimonials</a>
            <a href="{{ route('blog') }}" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Blog</a>
            <a href="{{ route('contact') }}" class="rounded-lg px-3 py-2 font-display text-[15px] font-medium text-stone-700 hover:bg-brand-50 hover:text-brand-700">Contact</a>
            <a href="{{ $navCta['href'] ?? '/services' }}" class="mt-2 rounded-full bg-gradient-to-r from-brand-400 to-brand-600 px-5 py-2.5 text-center text-sm font-semibold text-white">{{ $navCta['label'] ?? 'Our Services' }}</a>
        </div>
    </div>
</header>
