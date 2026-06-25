@php
    $item = function (string $label, string $href, bool $active, string $icon) {
        $base = 'flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition';
        $state = $active ? 'bg-white/10 text-white' : 'text-brand-100/80 hover:bg-white/5 hover:text-white';
        return ['label' => $label, 'href' => $href, 'class' => "$base $state", 'icon' => $icon];
    };
    $icons = [
        'dashboard' => 'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z',
        'home'  => 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.5a.75.75 0 00.75.75h3.75v-6a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v6h3.75a.75.75 0 00.75-.75V9.75',
        'services' => 'M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63',
        'projects' => 'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z',
        'blog' => 'M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5',
        'content' => 'M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z',
        'team' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
        'quote' => 'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25z',
        'mail' => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75',
        'layout' => 'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25z',
        'settings' => 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
    ];
@endphp

<aside data-admin-sidebar
       class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full overflow-y-auto bg-brand-900 px-4 py-5 transition-transform duration-200 lg:translate-x-0">

    {{-- Brand --}}
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-2">
        <img src="{{ asset($settings->get('site.logo', 'images/logo.svg')) }}" alt="" class="h-10 w-10 rounded-full ring-1 ring-white/20">
        <span class="leading-tight">
            <span class="block font-display text-base font-bold text-white">{{ $settings->get('site.name', config('app.name')) }}</span>
            <span class="block text-[10px] font-semibold uppercase tracking-[0.2em] text-brand-300">Admin Panel</span>
        </span>
    </a>

    <nav class="mt-7 space-y-1">
        @php
            $links = [
                $item('Dashboard', route('admin.dashboard'), request()->routeIs('admin.dashboard'), $icons['dashboard']),
                $item('Homepage', route('admin.homepage.edit'), request()->routeIs('admin.homepage.*'), $icons['home']),
                $item('Services', route('admin.services.index'), request()->routeIs('admin.services.*'), $icons['services']),
                $item('Projects', route('admin.projects.index'), request()->routeIs('admin.projects.*'), $icons['projects']),
                $item('Blog', route('admin.blog.index'), request()->routeIs('admin.blog.*'), $icons['blog']),
            ];
        @endphp
        @foreach ($links as $l)
            <a href="{{ $l['href'] }}" class="{{ $l['class'] }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $l['icon'] }}"/></svg>
                {{ $l['label'] }}
            </a>
        @endforeach

        <p class="px-3 pb-1 pt-5 text-[11px] font-semibold uppercase tracking-wider text-brand-400">Site Content</p>
        @php
            $content = [
                $item('About Page', route('admin.site-content.about.edit'), request()->routeIs('admin.site-content.about.*'), $icons['content']),
                $item('Page Banners', route('admin.site-content.banners.edit'), request()->routeIs('admin.site-content.banners.*'), 'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z'),
                $item('Team', route('admin.team.index'), request()->routeIs('admin.team.*'), $icons['team']),
                $item('Testimonials', route('admin.testimonials.index'), request()->routeIs('admin.testimonials.*'), $icons['quote']),
                $item('Contact', route('admin.site-content.contact.edit'), request()->routeIs('admin.site-content.contact.*'), $icons['mail']),
                $item('Footer & Nav', route('admin.site-content.footer.edit'), request()->routeIs('admin.site-content.footer.*'), $icons['layout']),
            ];
        @endphp
        @foreach ($content as $l)
            <a href="{{ $l['href'] }}" class="{{ $l['class'] }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $l['icon'] }}"/></svg>
                {{ $l['label'] }}
            </a>
        @endforeach

        <p class="px-3 pb-1 pt-5 text-[11px] font-semibold uppercase tracking-wider text-brand-400">System</p>
        <a href="{{ route('admin.settings.edit') }}" class="{{ $item('Settings', '#', request()->routeIs('admin.settings.*'), '')['class'] }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons['settings'] }}"/></svg>
            Settings
        </a>
    </nav>
</aside>
