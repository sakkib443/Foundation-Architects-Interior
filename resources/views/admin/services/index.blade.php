@extends('layouts.admin')

@section('title', 'Services')
@section('heading', 'Services')

@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm text-stone-500">Manage the services shown on the public site.</p>
        <a href="{{ route('admin.services.create') }}" class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Add new
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
        @if ($services->isEmpty())
            <div class="px-6 py-16 text-center">
                <p class="font-display text-lg font-bold text-brand-900">No services yet</p>
                <p class="mt-1 text-sm text-stone-500">Get started by adding your first service.</p>
                <a href="{{ route('admin.services.create') }}" class="mt-5 inline-flex items-center gap-1.5 rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
                    Add new
                </a>
            </div>
        @else
            <table class="min-w-full divide-y divide-stone-200 text-left">
                <thead class="bg-stone-50 text-xs font-semibold uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">Tagline</th>
                        <th class="px-6 py-3">Published</th>
                        <th class="px-6 py-3">Sort</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-sm">
                    @foreach ($services as $service)
                        <tr class="transition hover:bg-stone-50/60">
                            <td class="px-6 py-4 font-medium text-brand-900">{{ $service->title }}</td>
                            <td class="px-6 py-4 text-stone-500">{{ $service->tagline ?: '—' }}</td>
                            <td class="px-6 py-4">
                                @if ($service->is_published)
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">Published</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-stone-100 px-2.5 py-0.5 text-xs font-semibold text-stone-500 ring-1 ring-stone-200">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-stone-500">{{ $service->sort_order }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.services.edit', $service) }}" class="text-xs font-semibold text-brand-600 hover:text-brand-800">Edit</a>
                                    <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-800">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
