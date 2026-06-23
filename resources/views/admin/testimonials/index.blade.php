@extends('layouts.admin')

@section('title', 'Testimonials')
@section('heading', 'Testimonials')

@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm text-stone-500">Manage the testimonials shown on the public site.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Add new
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
        @if ($testimonials->isEmpty())
            <div class="px-6 py-16 text-center">
                <p class="font-display text-lg font-bold text-brand-900">No testimonials yet</p>
                <p class="mt-1 text-sm text-stone-500">Get started by adding your first testimonial.</p>
                <a href="{{ route('admin.testimonials.create') }}" class="mt-5 inline-flex items-center gap-1.5 rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
                    Add new
                </a>
            </div>
        @else
            <table class="min-w-full divide-y divide-stone-200 text-left">
                <thead class="bg-stone-50 text-xs font-semibold uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Rating</th>
                        <th class="px-6 py-3">Published</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-sm">
                    @foreach ($testimonials as $testimonial)
                        <tr class="transition hover:bg-stone-50/60">
                            <td class="px-6 py-4 font-medium text-brand-900">{{ $testimonial->name }}</td>
                            <td class="px-6 py-4 text-stone-500">{{ $testimonial->role ?: '—' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-0.5">
                                    @for ($s = 0; $s < 5; $s++)
                                        <svg class="h-4 w-4 {{ $s < $testimonial->rating ? 'text-amber-400' : 'text-stone-200' }}" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($testimonial->is_published)
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">Published</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-stone-100 px-2.5 py-0.5 text-xs font-semibold text-stone-500 ring-1 ring-stone-200">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-xs font-semibold text-brand-600 hover:text-brand-800">Edit</a>
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Delete this testimonial? This cannot be undone.');">
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
