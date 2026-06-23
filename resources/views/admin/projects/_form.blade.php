@php
    $scopeRows = array_values((array) old('scope', $project->scope ?? []));
    $gallery = $project->gallery ?? [];
@endphp

<div class="space-y-6">

    {{-- Basics --}}
    <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
        <h2 class="font-display text-base font-bold text-brand-900">Details</h2>
        <div class="mt-4 grid gap-5 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <x-form.input name="title" label="Title" :value="$project->title" required />
            </div>
            <div class="sm:col-span-2">
                <x-form.input name="slug" label="Slug" :value="$project->slug" hint="Leave blank to generate from the title." />
            </div>
            <x-form.input name="category" label="Category" :value="$project->category" />
            <x-form.input name="location" label="Location" :value="$project->location" />
            <x-form.input name="year" label="Year" :value="$project->year" />
            <x-form.input name="area" label="Area" :value="$project->area" />
        </div>
    </div>

    {{-- Content --}}
    <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
        <h2 class="font-display text-base font-bold text-brand-900">Content</h2>
        <div class="mt-4 space-y-5">
            <x-form.textarea name="summary" label="Summary" :value="$project->summary" rows="3" />
            <x-form.textarea name="overview" label="Overview" :value="$project->overview" rows="6" />
        </div>
    </div>

    {{-- Cover image --}}
    <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
        <h2 class="font-display text-base font-bold text-brand-900">Cover image</h2>
        <div class="mt-4">
            <x-form.file name="image" label="Image" :current="$project->image" />
        </div>
    </div>

    {{-- Scope repeater --}}
    <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
        <h2 class="font-display text-base font-bold text-brand-900">Scope of work</h2>
        <p class="mt-1 text-sm text-stone-500">One item per row.</p>

        <div class="mt-4" data-repeater data-next="{{ count($scopeRows) }}">
            <div class="space-y-3" data-repeater-items>
                @foreach ($scopeRows as $i => $item)
                    <div class="flex items-center gap-3" data-repeater-row>
                        <input type="text" name="scope[{{ $i }}]" value="{{ $item }}" placeholder="e.g. Space planning"
                            class="block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                        <button type="button" data-repeater-remove class="shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @endforeach
            </div>

            <template data-repeater-template>
                <div class="flex items-center gap-3" data-repeater-row>
                    <input type="text" name="scope[__i__]" value="" placeholder="e.g. Space planning"
                        class="block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                    <button type="button" data-repeater-remove class="shrink-0 rounded-lg p-2 text-stone-400 transition hover:bg-rose-50 hover:text-rose-600" aria-label="Remove">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </template>

            <button type="button" data-repeater-add class="mt-4 inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add item
            </button>
        </div>
    </div>

    {{-- Gallery --}}
    <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
        <h2 class="font-display text-base font-bold text-brand-900">Gallery</h2>
        <p class="mt-1 text-sm text-stone-500">Uncheck an image to remove it. Use the field below to add more.</p>

        @if (!empty($gallery))
            <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                @foreach ($gallery as $path)
                    <label class="group relative block cursor-pointer overflow-hidden rounded-xl ring-1 ring-stone-200">
                        <img src="{{ asset($path) }}" alt="" class="aspect-square w-full object-cover transition group-has-[:not(:checked)]:opacity-30">
                        <span class="absolute left-2 top-2 inline-flex items-center gap-1.5 rounded-full bg-white/90 px-2.5 py-1 text-xs font-semibold text-stone-700 shadow-sm backdrop-blur">
                            <input type="checkbox" name="gallery[]" value="{{ $path }}" checked class="h-3.5 w-3.5 rounded border-stone-300 text-brand-600 focus:ring-brand-500">
                            Keep
                        </span>
                    </label>
                @endforeach
            </div>
        @else
            <p class="mt-4 text-sm text-stone-400">No gallery images yet.</p>
        @endif

        <div class="mt-5">
            <label for="gallery_new" class="block text-sm font-medium text-brand-900">Add images</label>
            <input type="file" name="gallery_new[]" id="gallery_new" multiple accept="image/*"
                class="mt-2 block w-full text-sm text-stone-500 file:mr-4 file:rounded-full file:border-0 file:bg-brand-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-700 hover:file:bg-brand-100">
            <p class="mt-1 text-xs text-stone-400">JPG/PNG/WebP. You can select multiple files.</p>
            @error('gallery_new.*')<p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>@enderror
        </div>
    </div>

    {{-- Publish --}}
    <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
        <h2 class="font-display text-base font-bold text-brand-900">Visibility</h2>
        <div class="mt-4">
            <x-form.toggle name="is_published" label="Published" :checked="(bool) ($project->is_published ?? false)" />
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex items-center gap-3">
        <button type="submit" class="inline-flex items-center gap-1.5 rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
            Save project
        </button>
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center rounded-full border border-stone-200 bg-white px-6 py-2.5 text-sm font-semibold text-stone-600 transition hover:bg-stone-50">
            Cancel
        </a>
    </div>

</div>
