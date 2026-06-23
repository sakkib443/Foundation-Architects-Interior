<div class="space-y-6 rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
    <x-form.input name="name" label="Name" :value="$testimonial->name" required />

    <x-form.input name="role" label="Role" :value="$testimonial->role" hint="e.g. Homeowner, Dhaka." />

    <x-form.select name="rating" label="Rating" :value="$testimonial->rating ?? 5" :options="[1, 2, 3, 4, 5]" required />

    <x-form.textarea name="text" label="Testimonial" rows="5" :value="$testimonial->text" required />

    <x-form.toggle name="is_published" label="Published" :checked="$testimonial->is_published ?? false" />
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
        Save testimonial
    </button>
    <a href="{{ route('admin.testimonials.index') }}" class="rounded-full border border-stone-200 bg-white px-6 py-2.5 text-sm font-semibold text-stone-600 transition hover:bg-stone-50">
        Cancel
    </a>
</div>
