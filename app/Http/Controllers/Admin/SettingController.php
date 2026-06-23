<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Support\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class SettingController extends Controller
{
    use HandlesUploads;

    public function edit(): View
    {
        $s = app(Settings::class);
        $site = $s->get('site', []);

        return view('admin.settings.edit', compact('site'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'seo_description'  => ['nullable', 'string'],
            'brand_colors'     => ['nullable', 'array'],
            'brand_colors.*'   => ['nullable', 'string', 'max:32'],
            'fonts'            => ['nullable', 'array'],
            'fonts.*'          => ['nullable', 'string', 'max:255'],
            'social'           => ['nullable', 'array'],
            'social.*'         => ['nullable', 'string', 'max:255'],
            'contact'          => ['nullable', 'array'],
            'contact.*'        => ['nullable', 'string', 'max:255'],
            'logo'             => ['nullable', 'image', 'max:4096'],
            'favicon'          => ['nullable', 'image', 'max:4096'],
        ]);

        $s = app(Settings::class);

        // Start from the existing group so any field not posted is preserved,
        // keeping the full `site` shape the public site depends on.
        $site = $s->get('site', []);
        if (! is_array($site)) {
            $site = [];
        }

        $site['name'] = $validated['name'];

        // Nested SEO description (stored under seo.description).
        Arr::set($site, 'seo.description', $validated['seo_description'] ?? null);

        // Overlay each posted nested group onto the existing values so that
        // partially submitted forms never wipe sibling keys.
        foreach (['brand_colors', 'fonts', 'social', 'contact'] as $group) {
            $existing = Arr::get($site, $group, []);
            if (! is_array($existing)) {
                $existing = [];
            }

            $posted = $validated[$group] ?? [];
            $site[$group] = array_merge($existing, $posted);
        }

        // Uploads: replace only when a new file is provided, else keep current.
        if ($request->hasFile('logo')) {
            $site['logo'] = $this->storeUpload($request, 'logo', 'site');
        }

        if ($request->hasFile('favicon')) {
            $site['favicon'] = $this->storeUpload($request, 'favicon', 'site');
        }

        $s->set('site', $site);

        return redirect()->route('admin.settings.edit')
            ->with('status', 'Settings saved.');
    }
}
