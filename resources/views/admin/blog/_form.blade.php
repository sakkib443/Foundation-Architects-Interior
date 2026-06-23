@php
    // Existing paragraphs for the body repeater; fall back to a single empty row.
    $bodyRows = old('body', $blog->body ?? []);
    if (empty($bodyRows)) {
        $bodyRows = [''];
    }
    $bodyRows = array_values($bodyRows);
@endphp

<div class="space-y-6 rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">

    <x-form.input name="title" label="Title" :value="$blog->title ?? ''" required />

    <x-form.input name="slug" label="Slug" :value="$blog->slug ?? ''" hint="Leave blank to generate from the title." />

    <div class="grid gap-6 sm:grid-cols-2">
        <x-form.input name="category" label="Category" :value="$blog->category ?? ''" />
        <x-form.input name="date" label="Date" :value="$blog->date ?? ''" hint="e.g. 26 Apr, 2026" />
    </div>

    <x-form.input name="read" label="Read time (minutes)" type="number" :value="$blog->read ?? ''" />

    <x-form.textarea name="excerpt" label="Excerpt" rows="3" :value="$blog->excerpt ?? ''" />

    <x-form.file name="image" label="Featured image" :current="$blog->image ?? null" />

    {{-- Body paragraphs (repeater) --}}
    <div data-repeater data-next="{{ count($bodyRows) }}">
        <label class="block text-sm font-medium text-brand-900">Body paragraphs</label>
        <p class="mt-1 text-xs text-stone-400">Each box is one paragraph. Empty paragraphs are dropped on save.</p>

        <div data-repeater-items class="mt-3 space-y-3">
            @foreach ($bodyRows as $i => $paragraph)
                <div data-repeater-row class="flex items-start gap-3">
                    <textarea name="body[{{ $i }}]" rows="3"
                        class="block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30"
                        placeholder="Paragraph text…">{{ $paragraph }}</textarea>
                    <button type="button" data-repeater-remove class="mt-1 shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove paragraph">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endforeach
        </div>

        <template data-repeater-template>
            <div data-repeater-row class="flex items-start gap-3">
                <textarea name="body[__i__]" rows="3"
                    class="block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30"
                    placeholder="Paragraph text…"></textarea>
                <button type="button" data-repeater-remove class="mt-1 shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove paragraph">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </template>

        <button type="button" data-repeater-add class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Add paragraph
        </button>
    </div>

    <x-form.toggle name="is_published" label="Published" :checked="old('is_published', $blog->is_published ?? true)" />
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center gap-1.5 rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
        Save post
    </button>
    <a href="{{ route('admin.blog.index') }}" class="inline-flex items-center rounded-full border border-stone-200 bg-white px-6 py-2.5 text-sm font-semibold text-stone-600 transition hover:bg-stone-50">
        Cancel
    </a>
</div>
