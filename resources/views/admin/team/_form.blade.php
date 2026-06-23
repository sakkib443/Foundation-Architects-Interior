<div class="space-y-6 rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
    <x-form.input name="name" label="Name" :value="$team->name" required />

    <x-form.input name="role" label="Role" :value="$team->role" hint="e.g. Sr. Architect." />

    <x-form.file name="photo" label="Photo" :current="$team->photo ?? null" />

    <x-form.toggle name="is_published" label="Published" :checked="$team->is_published ?? false" />
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="rounded-full bg-gradient-to-r from-brand-500 to-brand-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:shadow-md">
        Save team member
    </button>
    <a href="{{ route('admin.team.index') }}" class="rounded-full border border-stone-200 bg-white px-6 py-2.5 text-sm font-semibold text-stone-600 transition hover:bg-stone-50">
        Cancel
    </a>
</div>
