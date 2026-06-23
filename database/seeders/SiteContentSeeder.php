<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds the Site-Content settings groups (`about`, `contact`) with the values
 * that were previously hardcoded in the About page sections and the Contact
 * page. Editable from the admin Site Content area. Footer + Nav groups live in
 * CoreSettingsSeeder; the contact PAGE cards intentionally restate site.contact
 * so each card can carry its own label / link / icon.
 */
class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->put('about', [
            // sections/about/story.blade.php
            'story' => [
                'headline'   => 'Building Spaces, Crafting Lifestyles',
                'paragraphs' => [
                    'Foundation Architects & Interior began in 2016 with a simple belief — that good design should be honest, functional, and made for the people who live in it. What started as a small team of dreamers has grown into a full-service architecture and interior studio trusted across Bangladesh.',
                    'From the first sketch to the final handover, we manage every detail in-house — architecture, interior styling, 3D visualization, and on-site execution. The result is a calm, seamless experience and spaces that stand the test of time.',
                ],
                'highlights' => [
                    'Concept-to-handover, end-to-end delivery',
                    'Faith, honesty & transparent pricing',
                    'In-house architects, designers & 3D artists',
                ],
                'year'   => '10+',
                'badge'  => "Years of\nDesign Excellence",
                'images' => [
                    'images/portfolio/project-1.jpg',
                    'images/portfolio/project-3.jpg',
                    'images/portfolio/project-4.jpg',
                    'images/portfolio/project-2.jpg',
                ],
            ],

            // sections/about/vision-mission.blade.php
            'vision_mission' => [
                [
                    'tag'         => 'Our Vision',
                    'title'       => "To Become Bangladesh's Most Trusted Design Studio",
                    'description' => "Establishing Foundation Architects & Interior as the country's most valued brand in interior design — known for integrity, innovation, and spaces that elevate everyday life.",
                    'icon'        => 'M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                    'accent'      => 'from-brand-500 to-brand-700',
                ],
                [
                    'tag'         => 'Our Mission',
                    'title'       => 'Designing Functional Spaces That Inspire',
                    'description' => 'To transform every space into a calm, functional, and beautiful environment — delivered on time, within budget, and crafted with honest materials and skilled hands.',
                    'icon'        => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z',
                    'accent'      => 'from-brand-600 to-brand-800',
                ],
            ],

            // sections/about/timeline.blade.php
            'timeline' => [
                ['year' => '2016', 'title' => 'The Foundation', 'description' => 'Founded in Dhaka with a clear purpose — to deliver honest, modern interior design and bring premium quality within reach for Bangladeshi homes.'],
                ['year' => '2018', 'title' => 'Portfolio Expansion', 'description' => 'Grew beyond homes into commercial and corporate spaces — cafés, offices, and retail — successfully delivering on time and on budget.'],
                ['year' => '2020', 'title' => '3D Visualization & R&D', 'description' => 'Adopted advanced 3D visualization and a dedicated R&D approach, letting clients walk through their space before a single brick is laid.'],
                ['year' => '2022', 'title' => 'Organizational Growth', 'description' => 'Structured in-house teams for architecture, interior, 3D, and project operations — scaling delivery without ever compromising on quality.'],
                ['year' => '2024', 'title' => '500+ Clients Milestone', 'description' => 'Celebrated serving over 500 satisfied clients, driven by transparent pricing and a genuinely friendly, design-first experience.'],
                ['year' => '2026', 'title' => 'Looking Forward', 'description' => 'Today we keep pushing the craft — sustainable materials, smarter spaces, and a vision to become the most trusted interior brand in the country.'],
            ],

            // sections/about/founder.blade.php
            'founder' => [
                'name'  => 'Md. Ashraful Haque',
                'title' => 'Founder & Principal Architect',
                'photo' => 'images/team/founder.jpg',
                'bio1'  => 'A visionary architect with a passion for honest, people-first design, our founder started Foundation Architects & Interior in 2016 to raise the standard of interior design in Bangladesh.',
                'bio2'  => 'With a background in architecture and over a decade of hands-on experience, he leads the studio with a simple promise — every space we deliver should be beautiful, functional, and built with integrity.',
                'quote' => "Great design isn't about luxury — it's about creating spaces where life feels effortless.",
                'stats' => [
                    ['v' => '10+', 'l' => 'Years Leading'],
                    ['v' => '500+', 'l' => 'Projects Guided'],
                    ['v' => 'B.Arch', 'l' => 'Qualified'],
                ],
            ],

            // sections/about/values.blade.php
            'values' => [
                [
                    'title'       => 'Award-Winning Design',
                    'description' => 'Recognised excellence in interior design with industry-leading, on-trend concepts.',
                    'icon'        => 'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0',
                ],
                [
                    'title'       => 'Expert In-House Team',
                    'description' => 'Seasoned architects, designers, and 3D artists collaborating under one roof.',
                    'icon'        => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
                ],
                [
                    'title'       => 'Client-Focused',
                    'description' => 'Your taste guides every decision — clear communication from concept to keys.',
                    'icon'        => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z',
                ],
                [
                    'title'       => 'On-Time & On-Budget',
                    'description' => 'Transparent pricing and disciplined delivery — no surprises, ever.',
                    'icon'        => 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z',
                ],
            ],

            // sections/about/cta.blade.php
            'cta' => [
                'tagline'  => "Let's Work Together",
                'headline' => 'Ready to Build Your Dream Space?',
                'subtitle' => "Tell us about your space and your vision — our team will turn it into a place you'll love to live and work in. Your free consultation is just one call away.",
                'buttons'  => [
                    ['label' => 'Free Consultation', 'href' => 'tel:+8801722752657'],
                    ['label' => 'View Our Work', 'href' => '#projects'],
                ],
            ],
        ]);

        $this->put('contact', [
            // contact.blade.php — $contactCards
            'cards' => [
                [
                    'label' => 'Visit our studio',
                    'value' => 'House-27, Road-12, Shekertak, Mohammadpur, Dhaka',
                    'href'  => 'https://maps.google.com/?q=Mohammadpur+Dhaka',
                    'icon'  => 'M12 11.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z M19.5 9.5c0 6.5-7.5 12-7.5 12s-7.5-5.5-7.5-12a7.5 7.5 0 0115 0z',
                ],
                [
                    'label' => 'Call us',
                    'value' => '+880 1722-752657',
                    'href'  => 'tel:+8801722752657',
                    'icon'  => 'M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.515l.86 3.44a2 2 0 01-.45 1.95L8.21 11.29a11 11 0 004.5 4.5l1.385-1.42a2 2 0 011.95-.45l3.44.86A2 2 0 0121 16.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
                ],
                [
                    'label' => 'WhatsApp',
                    'value' => '+880 1722-752657',
                    'href'  => 'https://wa.me/8801722752657',
                    'icon'  => 'M20.52 3.48A11.93 11.93 0 0012 0C5.37 0 0 5.37 0 12c0 2.12.55 4.16 1.6 5.97L0 24l6.18-1.62A11.94 11.94 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22a9.94 9.94 0 01-5.07-1.39l-.36-.21-3.67.96.98-3.58-.23-.37A9.95 9.95 0 1122 12c0 5.52-4.48 10-10 10z',
                ],
                [
                    'label' => 'Email us',
                    'value' => 'f.architects2016@gmail.com',
                    'href'  => 'mailto:f.architects2016@gmail.com',
                    'icon'  => 'M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm0 2v.01L12 13l8-6.99V6H4zm16 2.236L12 15l-8-6.764V18h16V8.236z',
                ],
            ],

            // contact.blade.php — office hours block
            'hours' => [
                'days'   => 'Saturday — Thursday',
                'time'   => '10:00 AM — 7:00 PM',
                'closed' => 'Closed on Fridays',
            ],

            // contact.blade.php — subject <select> options
            'subjects' => [
                'Residential Design',
                'Commercial Interior',
                'Modular Kitchen',
                '3D Visualization',
                'Turnkey Project',
                'Other',
            ],
        ]);
    }

    protected function put(string $key, array $value): void
    {
        Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
