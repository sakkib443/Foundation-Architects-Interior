<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds the `homepage` settings group with the exact values that were
 * previously hard-coded in the public home page views (hero, stats, working
 * process and the home "about intro" section). Running this leaves the public
 * home page looking identical, but now driven by editable settings.
 *
 * Icon formats mirror how each view consumes them:
 *  - stats[].icon    => full inner SVG markup (rendered with {!! !!})
 *  - process[].icon  => a single <path> "d" attribute string
 *  - about features  => a single <path> "d" attribute string
 */
class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(['key' => 'homepage'], ['value' => [

            'hero' => [
                'slides' => [
                    'images/hero/slide-1.jpg',
                    'images/hero/slide-2.jpg',
                    'images/hero/slide-3.jpg',
                ],
                'tagline'  => 'Foundation Architects & Interior, Design for Life.',
                'headline' => 'Crafting Beautiful Interiors Across Bangladesh',
                'subtitle' => "A trusted name in the interior sector — turning your space into a place you'll love to live and work in.",
                'buttons'  => [
                    ['label' => 'View Projects', 'href' => '#projects'],
                    ['label' => 'Free Consultation', 'href' => 'tel:+8801722752657'],
                ],
            ],

            'stats' => [
                [
                    'value' => '15+',
                    'label' => 'Awards Won',
                    'icon'  => '<circle cx="12" cy="8" r="6"/><path stroke-linecap="round" stroke-linejoin="round" d="M8.21 13.89L7 22l5-3 5 3-1.21-8.12"/>',
                ],
                [
                    'value' => '500+',
                    'label' => 'Happy Clients',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>',
                ],
                [
                    'value' => '100%',
                    'label' => 'Quality Assured',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                ],
                [
                    'value' => '98%',
                    'label' => 'Client Satisfaction',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>',
                ],
            ],

            'process' => [
                [
                    'title'       => 'Initial Consultation',
                    'time'        => '1–2 hours',
                    'description' => 'We listen to your needs, budget, and vision to set the right foundation.',
                    'icon'        => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z',
                ],
                [
                    'title'       => 'Concept Development',
                    'time'        => '1–2 weeks',
                    'description' => 'Mood boards, themes, and concepts crafted around your personal style.',
                    'icon'        => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                ],
                [
                    'title'       => 'Space Planning',
                    'time'        => '2–3 weeks',
                    'description' => 'Smart, functional layouts that make the most of every corner.',
                    'icon'        => 'M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z',
                ],
                [
                    'title'       => 'Design Development',
                    'time'        => '2–7 weeks',
                    'description' => 'Detailed 3D designs, materials, and finishes finalized to perfection.',
                    'icon'        => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                ],
                [
                    'title'       => 'Implementation',
                    'time'        => '6–12 weeks',
                    'description' => 'Skilled execution and on-site management until everything is built.',
                    'icon'        => 'M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.348-.422.94-.502 1.396-.27M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63',
                ],
                [
                    'title'       => 'Final Handover',
                    'time'        => 'Project Complete',
                    'description' => 'A final walkthrough and the keys to your beautifully transformed space.',
                    'icon'        => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                ],
            ],

            'about' => [
                'headline' => 'Elegant, Functional & Timeless Interiors',
                'body'     => 'Foundation Architects & Interior is a trusted name in the interior sector of Bangladesh — working with faith and honesty. From concept to handover, we design and build beautiful, functional spaces for homes, offices, and commercial projects — tailored to your taste, lifestyle, and budget.',
                'features' => [
                    [
                        'title'       => 'Custom Design',
                        'description' => 'Tailored to your taste, space & budget.',
                        'icon'        => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z',
                    ],
                    [
                        'title'       => 'On-Time Handover',
                        'description' => 'Projects delivered right on schedule.',
                        'icon'        => 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                    [
                        'title'       => 'Quality Guaranteed',
                        'description' => 'Premium materials & expert craftsmanship.',
                        'icon'        => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.249-8.25-3.286z',
                    ],
                    [
                        'title'       => 'Fair & Honest Price',
                        'description' => 'Premium quality at transparent prices.',
                        'icon'        => 'M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z',
                    ],
                ],
                'image_main'      => 'images/portfolio/project-2.jpg',
                'image_secondary' => 'images/portfolio/project-1.jpg',
                'badge'           => '100% Satisfaction',
                'badge2'          => ['value' => '10+', 'label' => 'Years Experience'],
            ],

        ]]);
    }
}
