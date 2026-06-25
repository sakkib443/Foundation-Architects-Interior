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
    @php
        // Admin-editable fonts: build a deduplicated Google Fonts request + var overrides.
        $fonts = $settings->get('site.fonts', []);
        $fDisplay = $fonts['display'] ?? 'Playfair Display';
        $fScript  = $fonts['script'] ?? 'Poppins';
        $fSans    = $fonts['sans'] ?? 'Poppins';

        // Collapse duplicate families (e.g. when script === sans) — the CSS2 API
        // returns 400 if the same family is listed twice. A weighted spec wins
        // over a bare one for the same family.
        $families = [];
        foreach ([[$fSans, ':wght@400;500;600;700'], [$fDisplay, ':wght@400;500;600;700'], ['Hind Siliguri', ':wght@400;500;600;700'], [$fScript, '']] as [$fName, $fWeights]) {
            $fName = trim($fName);
            if ($fName === '') {
                continue;
            }
            if (! array_key_exists($fName, $families) || ($fWeights !== '' && $families[$fName] === '')) {
                $families[$fName] = $fWeights;
            }
        }
        $fontHref = 'https://fonts.googleapis.com/css2?'
            . implode('&', array_map(fn ($n) => 'family=' . str_replace(' ', '+', $n) . $families[$n], array_keys($families)))
            . '&display=swap';
        $brandColors = $settings->get('site.brand_colors', []);
    @endphp
    <link href="{{ $fontHref }}" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Admin-editable brand colours + fonts (override Tailwind theme tokens at runtime) --}}
    <style>:root{@if (!empty($brandColors))@foreach ($brandColors as $shade => $hex) --color-brand-{{ $shade }}:{{ $hex }};@endforeach @endif --font-display:'{{ $fDisplay }}','Hind Siliguri',ui-serif,Georgia,serif;--font-script:'{{ $fScript }}','Hind Siliguri',ui-sans-serif,sans-serif;--font-sans:'{{ $fSans }}','Hind Siliguri',ui-sans-serif,system-ui,sans-serif;}</style>
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
                <span class="preloader-brand-script">{{ $settings->get('site.brand_line1', 'Foundation') }}</span>
                <span class="preloader-brand-sub">{{ $settings->get('site.brand_line2', 'Architects & Interior') }}</span>
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

    @include('partials.whatsapp-float')

    @stack('scripts')
</body>
</html>
