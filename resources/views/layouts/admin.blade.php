<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') · {{ $settings->get('site.name', config('app.name')) }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset($settings->get('site.favicon', 'images/logo.svg')) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @stack('head')
</head>
<body class="h-full bg-stone-100 font-sans text-stone-800 antialiased">

    <div class="min-h-screen lg:pl-64">

        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        {{-- Backdrop (mobile) --}}
        <div data-admin-backdrop class="fixed inset-0 z-30 hidden bg-stone-900/40 lg:hidden"></div>

        {{-- Topbar --}}
        <header class="sticky top-0 z-20 flex h-16 items-center gap-4 border-b border-stone-200 bg-white/90 px-4 backdrop-blur sm:px-6">
            <button type="button" data-admin-toggle class="rounded-lg p-2 text-stone-500 hover:bg-stone-100 lg:hidden" aria-label="Toggle menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="font-display text-lg font-bold text-brand-900">@yield('heading', 'Dashboard')</h1>
            <div class="ml-auto flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="hidden items-center gap-1.5 rounded-lg border border-stone-200 px-3 py-1.5 text-sm font-medium text-stone-600 transition hover:bg-stone-50 sm:inline-flex">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    View site
                </a>
                <span class="hidden text-sm text-stone-500 sm:inline">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="inline-flex items-center gap-1.5 rounded-lg bg-brand-600 px-3 py-1.5 text-sm font-semibold text-white transition hover:bg-brand-700">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        {{-- Main --}}
        <main class="px-4 py-6 sm:px-6 lg:px-8">
            @include('admin.partials.flash')
            @yield('content')
        </main>
    </div>

    {{-- Admin JS: sidebar toggle, repeater, image preview (vanilla) --}}
    <script>
    (function () {
        // Sidebar slide-over (mobile)
        const sidebar = document.querySelector('[data-admin-sidebar]');
        const backdrop = document.querySelector('[data-admin-backdrop]');
        const toggle = document.querySelector('[data-admin-toggle]');
        const open = () => { sidebar?.classList.remove('-translate-x-full'); backdrop?.classList.remove('hidden'); };
        const close = () => { sidebar?.classList.add('-translate-x-full'); backdrop?.classList.add('hidden'); };
        toggle?.addEventListener('click', open);
        backdrop?.addEventListener('click', close);

        // Repeaters: clone the <template> row, reindex __i__ placeholders
        document.querySelectorAll('[data-repeater]').forEach((rep) => {
            let next = parseInt(rep.dataset.next || '0', 10);
            const list = rep.querySelector('[data-repeater-items]');
            const tpl = rep.querySelector('[data-repeater-template]');
            rep.querySelector('[data-repeater-add]')?.addEventListener('click', () => {
                const html = tpl.innerHTML.replaceAll('__i__', next);
                const wrap = document.createElement('div');
                wrap.innerHTML = html.trim();
                list.appendChild(wrap.firstElementChild);
                next++;
            });
        });
        // Remove row (delegated, works for cloned rows too)
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('[data-repeater-remove]');
            if (btn) { e.preventDefault(); btn.closest('[data-repeater-row]')?.remove(); }
        });

        // Tabbed panels: [data-tabs] contains [data-tab="key"] buttons + [data-panel="key"] panels
        document.querySelectorAll('[data-tabs]').forEach((group) => {
            const tabs = group.querySelectorAll('[data-tab]');
            const panels = group.querySelectorAll('[data-panel]');
            const activate = (key) => {
                tabs.forEach((t) => {
                    const on = t.dataset.tab === key;
                    t.classList.toggle('border-brand-600', on);
                    t.classList.toggle('text-brand-700', on);
                    t.classList.toggle('border-transparent', !on);
                    t.classList.toggle('text-stone-500', !on);
                });
                panels.forEach((p) => p.classList.toggle('hidden', p.dataset.panel !== key));
            };
            tabs.forEach((t) => t.addEventListener('click', () => activate(t.dataset.tab)));
            if (tabs.length) activate(tabs[0].dataset.tab);
        });

        // Image input live preview
        document.addEventListener('change', (e) => {
            const input = e.target.closest('input[type="file"][data-preview]');
            if (!input || !input.files?.[0]) return;
            const img = document.querySelector(input.dataset.preview);
            if (img) { img.src = URL.createObjectURL(input.files[0]); img.classList.remove('hidden'); }
        });
    })();
    </script>
    @stack('scripts')
</body>
</html>
