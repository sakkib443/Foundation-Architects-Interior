@php
    $features = old('features', $service->features ?? []);
    $features = is_array($features) ? array_values($features) : [];
@endphp

<div class="space-y-6 rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
    <x-form.input name="title" label="Title" :value="$service->title" required />

    <x-form.input name="slug" label="Slug" :value="$service->slug" hint="Leave blank to auto-generate from the title." />

    <x-form.input name="tagline" label="Tagline" :value="$service->tagline" />

    <x-form.textarea name="summary" label="Summary" rows="3" :value="$service->summary" />

    <x-form.textarea name="intro" label="Intro" rows="5" :value="$service->intro" />

    <x-form.input name="icon" label="Icon" :value="$service->icon" hint="SVG path data (the value of the path's d attribute)." />

    <x-form.file name="image" label="Image" :current="$service->image" />

    {{-- Features repeater --}}
    <div>
        <label class="block text-sm font-medium text-brand-900">Features</label>
        <p class="mt-1 text-xs text-stone-400">Highlight what this service includes. Rows with an empty title are ignored.</p>

        <div data-repeater data-next="{{ count($features) }}" class="mt-3 space-y-3">
            <div data-repeater-items class="space-y-3">
                @foreach ($features as $i => $feature)
                    <div data-repeater-row class="rounded-xl border border-stone-200 bg-stone-50/60 p-4">
                        <div class="grid gap-3 sm:grid-cols-2">
                            <input type="text" name="features[{{ $i }}][title]" value="{{ $feature['title'] ?? '' }}" placeholder="Feature title"
                                class="block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                            <input type="text" name="features[{{ $i }}][text]" value="{{ $feature['text'] ?? '' }}" placeholder="Short description"
                                class="block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                        </div>
                        <div class="mt-2 text-right">
                            <button type="button" data-repeater-remove class="text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <template data-repeater-template>
                <div data-repeater-row class="rounded-xl border border-stone-200 bg-stone-50/60 p-4">
                    <div class="grid gap-3 sm:grid-cols-2">
                        <input type="text" name="features[__i__][title]" placeholder="Feature title"
                            class="block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                        <input type="text" name="features[__i__][text]" placeholder="Short description"
                            class="block w-full rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm text-stone-800 placeholder-stone-400 shadow-sm transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                    </div>
                    <div class="mt-2 text-right">
                        <button type="button" data-repeater-remove class="text-xs font-semibold text-rose-600 hover:text-rose-800">Remove</button>
                    </div>
                </div>
            </template>

            <button type="button" data-repeater-add class="inline-flex items-center gap-1.5 rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add feature
            </button>
        </div>
    </div>

    <x-form.toggle name="is_published" label="Published" :checked="$service->is_published ?? false" />
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
        Save service
    </button>
    <a href="{{ route('admin.services.index') }}" class="rounded-full border border-stone-200 bg-white px-6 py-2.5 text-sm font-semibold text-stone-600 transition hover:bg-stone-50">
        Cancel
    </a>
</div>
