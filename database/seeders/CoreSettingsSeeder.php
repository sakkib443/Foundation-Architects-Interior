<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds the global settings groups (site, footer, nav) from values currently
 * hardcoded in the layout, navbar and footer. Homepage and Site-Content groups
 * are seeded by their own area seeders (HomepageSeeder, SiteContentSeeder).
 */
class CoreSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $this->put('site', [
            'name'    => config('app.name', 'Foundation Architects & Interior'),
            'logo'    => 'images/logo.svg',
            'favicon' => 'images/logo.svg',
            'seo'     => [
                'description' => 'Foundation Architects & Interior — a trusted interior design studio in Dhaka, Bangladesh. Designing beautiful, functional spaces for homes and offices.',
            ],
            'brand_colors' => [
                '50'  => '#eff6ff',
                '100' => '#dbeafe',
                '200' => '#bfdbfe',
                '300' => '#93c5fd',
                '400' => '#60a5fa',
                '500' => '#3b82f6',
                '600' => '#2563eb',
                '700' => '#1d4ed8',
                '800' => '#1e40af',
                '900' => '#1e3a8a',
            ],
            'fonts' => [
                'display' => 'Playfair Display',
                'script'  => 'Great Vibes',
                'sans'    => 'Poppins',
            ],
            'social' => [
                'facebook'  => '',
                'instagram' => '',
                'linkedin'  => '',
                'youtube'   => '',
            ],
            'contact' => [
                'address'         => 'House -27, Road -12, Shekertak, Mohammadpur, Dhaka',
                'phone'           => '+8801722752657',
                'phone_display'   => '01722-752657',
                'whatsapp'        => '8801722752657',
                'whatsapp_display' => '+880 1722-752657',
                'email'           => 'f.architects2016@gmail.com',
            ],
        ]);

        $this->put('footer', [
            'about' => 'A trusted name in the interior sector of Bangladesh — working with faith and honesty.',
            'links' => [
                ['label' => 'Home', 'href' => '/'],
                ['label' => 'About Us', 'href' => '/about'],
                ['label' => 'Projects', 'href' => '/projects'],
                ['label' => 'Contact', 'href' => '/contact'],
            ],
        ]);

        $this->put('nav', [
            'cta' => [
                'label' => 'Our Services',
                'href'  => '/services',
            ],
        ]);
    }

    protected function put(string $key, array $value): void
    {
        Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
