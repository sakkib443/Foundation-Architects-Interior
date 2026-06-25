<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Support\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Site Content area — edits the public About page sections, the Contact page
 * content, and the Footer/Nav. Each group is stored as one structured settings
 * row; updates rebuild the whole group array and persist it via Settings::set,
 * so the public views always read a complete, well-shaped payload.
 */
class SiteContentController extends Controller
{
    use HandlesUploads;

    /** Hub linking to the three editors. */
    public function index(): View
    {
        return view('admin.site-content.index');
    }

    /* ===================== ABOUT ===================== */

    public function aboutEdit(): View
    {
        $about = app(Settings::class)->get('about', []);
        if (! is_array($about)) {
            $about = [];
        }

        return view('admin.site-content.about', compact('about'));
    }

    public function aboutUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'story'              => ['nullable', 'array'],
            'story.headline'     => ['nullable', 'string', 'max:255'],
            'story.paragraphs'   => ['nullable', 'array'],
            'story.paragraphs.*' => ['nullable', 'string'],
            'story.highlights'   => ['nullable', 'array'],
            'story.highlights.*' => ['nullable', 'string', 'max:255'],
            'story.year'         => ['nullable', 'string', 'max:50'],
            'story.badge'        => ['nullable', 'string', 'max:255'],
            'story.images'       => ['nullable', 'array'],
            'story.images.*'     => ['nullable', 'string', 'max:255'],

            'vision_mission'               => ['nullable', 'array'],
            'vision_mission.*.tag'         => ['nullable', 'string', 'max:255'],
            'vision_mission.*.title'       => ['nullable', 'string', 'max:255'],
            'vision_mission.*.description' => ['nullable', 'string'],
            'vision_mission.*.icon'        => ['nullable', 'string'],
            'vision_mission.*.accent'      => ['nullable', 'string', 'max:255'],

            'timeline'               => ['nullable', 'array'],
            'timeline.*.year'        => ['nullable', 'string', 'max:50'],
            'timeline.*.title'       => ['nullable', 'string', 'max:255'],
            'timeline.*.description' => ['nullable', 'string'],

            'founder'         => ['nullable', 'array'],
            'founder.name'    => ['nullable', 'string', 'max:255'],
            'founder.title'   => ['nullable', 'string', 'max:255'],
            'founder.bio1'    => ['nullable', 'string'],
            'founder.bio2'    => ['nullable', 'string'],
            'founder.quote'   => ['nullable', 'string'],
            'founder.stats'   => ['nullable', 'array'],
            'founder.stats.*.v' => ['nullable', 'string', 'max:50'],
            'founder.stats.*.l' => ['nullable', 'string', 'max:255'],
            'founder_photo'   => ['nullable', 'image', 'max:4096'],

            'values'               => ['nullable', 'array'],
            'values.*.title'       => ['nullable', 'string', 'max:255'],
            'values.*.description' => ['nullable', 'string'],
            'values.*.icon'        => ['nullable', 'string'],

            'cta'           => ['nullable', 'array'],
            'cta.tagline'   => ['nullable', 'string', 'max:255'],
            'cta.headline'  => ['nullable', 'string', 'max:255'],
            'cta.subtitle'  => ['nullable', 'string'],
            'cta.buttons'   => ['nullable', 'array'],
            'cta.buttons.*.label' => ['nullable', 'string', 'max:255'],
            'cta.buttons.*.href'  => ['nullable', 'string', 'max:255'],
        ]);

        $settings = app(Settings::class);
        $current = $settings->get('about', []);
        $current = is_array($current) ? $current : [];

        $story = $validated['story'] ?? [];

        // Keep the existing founder photo unless a new file is uploaded.
        $founder = $validated['founder'] ?? [];
        $founder['photo'] = $request->hasFile('founder_photo')
            ? $this->storeUpload($request, 'founder_photo', 'about')
            : ($current['founder']['photo'] ?? null);
        $founder['stats'] = $this->cleanRows($founder['stats'] ?? []);

        $about = [
            'story' => [
                'headline'   => $story['headline'] ?? null,
                'paragraphs' => $this->cleanList($story['paragraphs'] ?? []),
                'highlights' => $this->cleanList($story['highlights'] ?? []),
                'year'       => $story['year'] ?? null,
                'badge'      => $story['badge'] ?? null,
                'images'     => $this->cleanList($story['images'] ?? []),
            ],
            'vision_mission' => $this->cleanRows($validated['vision_mission'] ?? []),
            'timeline'       => $this->cleanRows($validated['timeline'] ?? []),
            'founder'        => $founder,
            'values'         => $this->cleanRows($validated['values'] ?? []),
            'cta' => [
                'tagline'  => $validated['cta']['tagline'] ?? null,
                'headline' => $validated['cta']['headline'] ?? null,
                'subtitle' => $validated['cta']['subtitle'] ?? null,
                'buttons'  => $this->cleanRows($validated['cta']['buttons'] ?? []),
            ],
        ];

        $settings->set('about', $about);

        return redirect()->route('admin.site-content.about.edit')
            ->with('status', 'About page content saved.');
    }

    /* ===================== CONTACT ===================== */

    public function contactEdit(): View
    {
        $contact = app(Settings::class)->get('contact', []);
        if (! is_array($contact)) {
            $contact = [];
        }

        return view('admin.site-content.contact', compact('contact'));
    }

    public function contactUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cards'           => ['nullable', 'array'],
            'cards.*.label'   => ['nullable', 'string', 'max:255'],
            'cards.*.value'   => ['nullable', 'string', 'max:255'],
            'cards.*.href'    => ['nullable', 'string', 'max:255'],
            'cards.*.icon'    => ['nullable', 'string'],

            'hours'          => ['nullable', 'array'],
            'hours.days'     => ['nullable', 'string', 'max:255'],
            'hours.time'     => ['nullable', 'string', 'max:255'],
            'hours.closed'   => ['nullable', 'string', 'max:255'],

            'subjects'   => ['nullable', 'array'],
            'subjects.*' => ['nullable', 'string', 'max:255'],
        ]);

        $contact = [
            'cards' => $this->cleanRows($validated['cards'] ?? []),
            'hours' => [
                'days'   => $validated['hours']['days'] ?? null,
                'time'   => $validated['hours']['time'] ?? null,
                'closed' => $validated['hours']['closed'] ?? null,
            ],
            'subjects' => $this->cleanList($validated['subjects'] ?? []),
        ];

        app(Settings::class)->set('contact', $contact);

        return redirect()->route('admin.site-content.contact.edit')
            ->with('status', 'Contact page content saved.');
    }

    /* ===================== FOOTER + NAV ===================== */

    public function footerEdit(): View
    {
        $settings = app(Settings::class);

        $footer = $settings->get('footer', []);
        $footer = is_array($footer) ? $footer : [];

        $nav = $settings->get('nav', []);
        $nav = is_array($nav) ? $nav : [];

        return view('admin.site-content.footer', compact('footer', 'nav'));
    }

    public function footerUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'about'         => ['nullable', 'string'],
            'links'         => ['nullable', 'array'],
            'links.*.label' => ['nullable', 'string', 'max:255'],
            'links.*.href'  => ['nullable', 'string', 'max:255'],

            'nav_cta'        => ['nullable', 'array'],
            'nav_cta.label'  => ['nullable', 'string', 'max:255'],
            'nav_cta.href'   => ['nullable', 'string', 'max:255'],
        ]);

        $settings = app(Settings::class);

        $settings->set('footer', [
            'about' => $validated['about'] ?? null,
            'links' => $this->cleanRows($validated['links'] ?? []),
        ]);

        $settings->set('nav.cta', [
            'label' => $validated['nav_cta']['label'] ?? null,
            'href'  => $validated['nav_cta']['href'] ?? null,
        ]);

        return redirect()->route('admin.site-content.footer.edit')
            ->with('status', 'Footer & navigation saved.');
    }

    /* ===================== PAGE BANNERS ===================== */

    public function bannersEdit(): View
    {
        $heroes = app(Settings::class)->get('page_heroes', []);
        $heroes = is_array($heroes) ? $heroes : [];

        return view('admin.site-content.banners', compact('heroes'));
    }

    public function bannersUpdate(Request $request): RedirectResponse
    {
        $pages = ['about', 'services', 'projects', 'blog', 'testimonials', 'contact'];

        $request->validate([
            'heroes'             => ['nullable', 'array'],
            'heroes.*.eyebrow'   => ['nullable', 'string', 'max:255'],
            'heroes.*.title'     => ['nullable', 'string', 'max:255'],
            'heroes.*.subtitle'  => ['nullable', 'string', 'max:500'],
            'heroes.*.image'     => ['nullable', 'string', 'max:255'],
            'image_about'        => ['nullable', 'image', 'max:4096'],
            'image_services'     => ['nullable', 'image', 'max:4096'],
            'image_projects'     => ['nullable', 'image', 'max:4096'],
            'image_blog'         => ['nullable', 'image', 'max:4096'],
            'image_testimonials' => ['nullable', 'image', 'max:4096'],
            'image_contact'      => ['nullable', 'image', 'max:4096'],
        ]);

        $settings = app(Settings::class);
        $current = $settings->get('page_heroes', []);
        $current = is_array($current) ? $current : [];

        $heroes = [];
        foreach ($pages as $page) {
            $row = (array) $request->input("heroes.$page", []);
            $image = $row['image'] ?? ($current[$page]['image'] ?? null);
            if ($request->hasFile("image_$page")) {
                $image = $this->storeUpload($request, "image_$page", 'heroes');
            }
            $heroes[$page] = [
                'image'    => $image,
                'eyebrow'  => $row['eyebrow'] ?? '',
                'title'    => $row['title'] ?? '',
                'subtitle' => $row['subtitle'] ?? '',
            ];
        }

        $settings->set('page_heroes', $heroes);

        return redirect()->route('admin.site-content.banners.edit')
            ->with('status', 'Page banners saved.');
    }

    /* ===================== HELPERS ===================== */

    /**
     * Normalise a flat repeater list (array of scalar strings): reindex and drop
     * blank entries.
     *
     * @return list<string>
     */
    private function cleanList(mixed $items): array
    {
        if (! is_array($items)) {
            return [];
        }

        $clean = [];
        foreach ($items as $item) {
            if (is_string($item) && trim($item) !== '') {
                $clean[] = $item;
            }
        }

        return $clean;
    }

    /**
     * Normalise a repeater of associative rows: reindex and drop rows whose
     * every value is blank.
     *
     * @return list<array<string,mixed>>
     */
    private function cleanRows(mixed $rows): array
    {
        if (! is_array($rows)) {
            return [];
        }

        $clean = [];
        foreach ($rows as $row) {
            if (! is_array($row)) {
                continue;
            }

            $hasValue = false;
            foreach ($row as $value) {
                if (is_string($value) ? trim($value) !== '' : ! empty($value)) {
                    $hasValue = true;
                    break;
                }
            }

            if ($hasValue) {
                $clean[] = $row;
            }
        }

        return $clean;
    }
}
