<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Support\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Edits the `homepage` settings group: hero, stats, working-process steps and
 * the home "about intro" section. Everything is stored as one structured array
 * under the single `homepage` settings row.
 */
class HomepageController extends Controller
{
    use HandlesUploads;

    public function edit(): View
    {
        $home = app(Settings::class)->get('homepage', []);
        if (! is_array($home)) {
            $home = [];
        }

        return view('admin.homepage.edit', compact('home'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            // Hero
            'hero'                => ['nullable', 'array'],
            'hero.tagline'        => ['nullable', 'string'],
            'hero.headline'       => ['nullable', 'string'],
            'hero.subtitle'       => ['nullable', 'string'],
            'hero_slides'         => ['nullable', 'array'],
            'hero_slides.*'       => ['nullable', 'string'],
            'hero_slides_new'     => ['nullable', 'array'],
            'hero_slides_new.*'   => ['nullable', 'image', 'max:4096'],
            'hero_buttons'        => ['nullable', 'array'],

            // Repeaters
            'stats'               => ['nullable', 'array'],
            'process'             => ['nullable', 'array'],

            // About-intro
            'about'               => ['nullable', 'array'],
            'about.headline'      => ['nullable', 'string'],
            'about.body'          => ['nullable', 'string'],
            'about.badge'         => ['nullable', 'string'],
            'about_features'      => ['nullable', 'array'],
            'about_badge2'        => ['nullable', 'array'],
            'about_image_main_keep'      => ['nullable', 'string'],
            'about_image_secondary_keep' => ['nullable', 'string'],
            'about_image_main'           => ['nullable', 'image', 'max:4096'],
            'about_image_secondary'      => ['nullable', 'image', 'max:4096'],
        ]);

        $settings = app(Settings::class);
        $existing = $settings->get('homepage', []);
        if (! is_array($existing)) {
            $existing = [];
        }

        $home = [
            'hero'    => $this->buildHero($request),
            'stats'   => $this->buildStats($request),
            'process' => $this->buildProcess($request),
            'about'   => $this->buildAbout($request, $existing['about'] ?? []),
        ];

        $settings->set('homepage', $home);

        return redirect()->route('admin.homepage.edit')
            ->with('status', 'Homepage saved.');
    }

    /**
     * @return array<string, mixed>
     */
    private function buildHero(Request $request): array
    {
        // Slides: keep existing paths (hidden field, indexed) and merge any new uploads.
        $kept = array_values(array_filter(
            (array) $request->input('hero_slides', []),
            fn ($p) => is_string($p) && filled($p)
        ));
        $added = $this->storeUploads($request, 'hero_slides_new', 'homepage');
        $slides = array_values(array_merge($kept, $added));

        // Buttons repeater: label + href.
        $buttons = [];
        foreach ((array) $request->input('hero_buttons', []) as $row) {
            $label = is_array($row) ? trim((string) ($row['label'] ?? '')) : '';
            $href = is_array($row) ? trim((string) ($row['href'] ?? '')) : '';
            if ($label === '' && $href === '') {
                continue;
            }
            $buttons[] = ['label' => $label, 'href' => $href];
        }

        return [
            'slides'   => $slides,
            'tagline'  => (string) $request->input('hero.tagline', ''),
            'headline' => (string) $request->input('hero.headline', ''),
            'subtitle' => (string) $request->input('hero.subtitle', ''),
            'buttons'  => array_values($buttons),
        ];
    }

    /**
     * @return array<int, array<string, string>>
     */
    private function buildStats(Request $request): array
    {
        $out = [];
        foreach ((array) $request->input('stats', []) as $row) {
            if (! is_array($row)) {
                continue;
            }
            $value = trim((string) ($row['value'] ?? ''));
            $label = trim((string) ($row['label'] ?? ''));
            $icon = (string) ($row['icon'] ?? '');
            if ($value === '' && $label === '') {
                continue;
            }
            $out[] = ['value' => $value, 'label' => $label, 'icon' => $icon];
        }

        return array_values($out);
    }

    /**
     * @return array<int, array<string, string>>
     */
    private function buildProcess(Request $request): array
    {
        $out = [];
        foreach ((array) $request->input('process', []) as $row) {
            if (! is_array($row)) {
                continue;
            }
            $title = trim((string) ($row['title'] ?? ''));
            $time = trim((string) ($row['time'] ?? ''));
            $description = trim((string) ($row['description'] ?? ''));
            $icon = (string) ($row['icon'] ?? '');
            if ($title === '' && $description === '') {
                continue;
            }
            $out[] = [
                'title'       => $title,
                'time'        => $time,
                'description' => $description,
                'icon'        => $icon,
            ];
        }

        return array_values($out);
    }

    /**
     * @param  array<string, mixed>  $existingAbout
     * @return array<string, mixed>
     */
    private function buildAbout(Request $request, array $existingAbout): array
    {
        // Feature cards repeater.
        $features = [];
        foreach ((array) $request->input('about_features', []) as $row) {
            if (! is_array($row)) {
                continue;
            }
            $title = trim((string) ($row['title'] ?? ''));
            $description = trim((string) ($row['description'] ?? ''));
            $icon = (string) ($row['icon'] ?? '');
            if ($title === '' && $description === '') {
                continue;
            }
            $features[] = ['title' => $title, 'description' => $description, 'icon' => $icon];
        }

        // Images: new upload wins, otherwise keep the posted existing path.
        $imageMain = $this->storeUpload($request, 'about_image_main', 'homepage')
            ?: (string) $request->input('about_image_main_keep', $existingAbout['image_main'] ?? '');

        $imageSecondary = $this->storeUpload($request, 'about_image_secondary', 'homepage')
            ?: (string) $request->input('about_image_secondary_keep', $existingAbout['image_secondary'] ?? '');

        $badge2In = (array) $request->input('about_badge2', []);

        return [
            'headline'        => (string) $request->input('about.headline', ''),
            'body'            => (string) $request->input('about.body', ''),
            'features'        => array_values($features),
            'image_main'      => $imageMain,
            'image_secondary' => $imageSecondary,
            'badge'           => (string) $request->input('about.badge', ''),
            'badge2'          => [
                'value' => trim((string) ($badge2In['value'] ?? '')),
                'label' => trim((string) ($badge2In['label'] ?? '')),
            ],
        ];
    }
}
