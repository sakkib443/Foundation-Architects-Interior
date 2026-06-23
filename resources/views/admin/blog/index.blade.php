@extends('layouts.admin')

@section('title', 'Blog')
@section('heading', 'Blog')

@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm text-stone-500">Manage the blog posts shown on the public site.</p>
        <a href="{{ route('admin.blog.create') }}" class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Write post
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
        @if ($posts->isEmpty())
            <div class="px-6 py-16 text-center">
                <p class="font-display text-lg font-bold text-brand-900">No posts yet</p>
                <p class="mt-1 text-sm text-stone-500">Get started by writing your first post.</p>
                <a href="{{ route('admin.blog.create') }}" class="mt-5 inline-flex items-center gap-1.5 rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
                    Write post
                </a>
            </div>
        @else
            <table class="min-w-full divide-y divide-stone-200 text-left">
                <thead class="bg-stone-50 text-xs font-semibold uppercase tracking-wide text-stone-500">
                    <tr>
                        <th class="px-6 py-3">Image</th>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Published</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-sm">
                    @foreach ($posts as $post)
                        <tr class="transition hover:bg-stone-50/60">
                            <td class="px-6 py-4">
                                @if ($post->image)
                                    <img src="{{ asset($post->image) }}" alt="" class="h-12 w-16 rounded-lg object-cover ring-1 ring-stone-200">
                                @else
                                    <div class="flex h-12 w-16 items-center justify-center rounded-lg bg-stone-100 text-stone-300 ring-1 ring-stone-200">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-brand-900">{{ $post->title }}</td>
                            <td class="px-6 py-4 text-stone-500">{{ $post->category ?: '—' }}</td>
                            <td class="px-6 py-4 text-stone-500">{{ $post->date ?: '—' }}</td>
                            <td class="px-6 py-4">
                                @if ($post->is_published)
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">Published</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-stone-100 px-2.5 py-0.5 text-xs font-semibold text-stone-500 ring-1 ring-stone-200">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.blog.edit', $post) }}" class="text-xs font-semibold text-brand-600 hover:text-brand-800">Edit</a>
                                    <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" onsubmit="return confirm('Delete this post? This cannot be undone.');">
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
