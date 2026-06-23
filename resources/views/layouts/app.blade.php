<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', $settings->get('site.name', config('app.name', 'Foundation Architects & Interior')))</title>

    <meta name="description" content="@yield('meta_description', $settings->get('site.seo.description', 'Foundation Architects & Interior — a trusted interior design studio in Dhaka, Bangladesh. Designing beautiful, functional spaces for homes and offices.'))">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset($settings->get('site.favicon', 'images/logo.svg')) }}">

    {{-- Elegant display & script fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Hind+Siliguri:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Admin-editable brand colours (override Tailwind theme tokens at runtime) --}}
    @php($brandColors = $settings->get('site.brand_colors', []))
    @if (!empty($brandColors))
        <style>:root{@foreach ($brandColors as $shade => $hex) --color-brand-{{ $shade }}:{{ $hex }};@endforeach}</style>
    @endif
    @stack('head')
</head>
<body class="min-h-screen bg-brand-50 font-sans text-stone-800 antialiased">

    {{-- ===================== PRELOADER ===================== --}}
    <div id="preloader" aria-hidden="true">
        <div class="preloader-inner">
            <div class="preloader-frame">
                <span class="preloader-square preloader-square--a"></span>
                <span class="preloader-square preloader-square--b"></span>
                <img src="{{ asset('images/logo.svg') }}" alt="" class="preloader-logo">
            </div>
            <p class="preloader-brand">
                <span class="preloader-brand-script">Foundation</span>
                <span class="preloader-brand-sub">Architects &amp; Interior</span>
            </p>
            <div class="preloader-bar"><span></span></div>
        </div>
    </div>
    <noscript><style>#preloader{display:none!important;}.hero-rise{opacity:1!important;transform:none!important;}</style></noscript>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
