@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <p class="text-sm text-stone-500">Welcome back, {{ auth()->user()->name }}. Here's your site at a glance.</p>

    {{-- Count cards --}}
    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
        @php
            $cards = [
                ['label' => 'Services', 'count' => $counts['services'], 'href' => route('admin.services.index'), 'color' => 'from-blue-500 to-blue-600'],
                ['label' => 'Projects', 'count' => $counts['projects'], 'href' => route('admin.projects.index'), 'color' => 'from-indigo-500 to-indigo-600'],
                ['label' => 'Blog Posts', 'count' => $counts['posts'], 'href' => route('admin.blog.index'), 'color' => 'from-sky-500 to-sky-600'],
                ['label' => 'Testimonials', 'count' => $counts['testimonials'], 'href' => route('admin.testimonials.index'), 'color' => 'from-cyan-500 to-cyan-600'],
                ['label' => 'Team', 'count' => $counts['team'], 'href' => route('admin.team.index'), 'color' => 'from-teal-500 to-teal-600'],
            ];
        @endphp
        @foreach ($cards as $c)
            <a href="{{ $c['href'] }}" class="group rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="inline-flex rounded-xl bg-gradient-to-br {{ $c['color'] }} px-2.5 py-1 text-xs font-semibold text-white">{{ $c['label'] }}</div>
                <p class="mt-3 font-display text-3xl font-bold text-brand-900">{{ $c['count'] }}</p>
                <p class="mt-1 text-xs font-medium text-brand-600 opacity-0 transition group-hover:opacity-100">Manage &rarr;</p>
            </a>
        @endforeach
    </div>

    {{-- Quick actions --}}
    <div class="mt-8">
        <h2 class="font-display text-lg font-bold text-brand-900">Quick actions</h2>
        <div class="mt-3 flex flex-wrap gap-3">
            @foreach ([
                ['Edit homepage', route('admin.homepage.edit')],
                ['Add service', route('admin.services.create')],
                ['Add project', route('admin.projects.create')],
                ['Write post', route('admin.blog.create')],
                ['Site settings', route('admin.settings.edit')],
            ] as [$label, $href])
                <a href="{{ $href }}" class="inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Recent --}}
    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
            <h3 class="font-display text-base font-bold text-brand-900">Recent projects</h3>
            <ul class="mt-3 divide-y divide-stone-100">
                @forelse ($recent['projects'] as $p)
                    <li class="flex items-center justify-between py-2.5">
                        <span class="truncate text-sm text-stone-700">{{ $p->title }}</span>
                        <a href="{{ route('admin.projects.edit', $p) }}" class="ml-3 shrink-0 text-xs font-semibold text-brand-600 hover:text-brand-800">Edit</a>
                    </li>
                @empty
                    <li class="py-2.5 text-sm text-stone-400">No projects yet.</li>
                @endforelse
            </ul>
        </div>
        <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
            <h3 class="font-display text-base font-bold text-brand-900">Recent posts</h3>
            <ul class="mt-3 divide-y divide-stone-100">
                @forelse ($recent['posts'] as $p)
                    <li class="flex items-center justify-between py-2.5">
                        <span class="truncate text-sm text-stone-700">{{ $p->title }}</span>
                        <a href="{{ route('admin.blog.edit', $p) }}" class="ml-3 shrink-0 text-xs font-semibold text-brand-600 hover:text-brand-800">Edit</a>
                    </li>
                @empty
                    <li class="py-2.5 text-sm text-stone-400">No posts yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
