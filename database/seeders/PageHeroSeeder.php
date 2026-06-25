<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds the editable hero banners (image + eyebrow + title + subtitle) for the
 * inner pages, from the values previously hardcoded in each page view.
 */
class PageHeroSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(['key' => 'page_heroes'], ['value' => [
            'about' => [
                'image'    => 'images/hero/slide-2.jpg',
                'eyebrow'  => 'Get to Know Us',
                'title'    => 'About Foundation Architects & Interior',
                'subtitle' => 'Where vision meets craftsmanship — a studio built on faith, honesty, and a passion for designing spaces that feel like home.',
            ],
            'services' => [
                'image'    => 'images/hero/slide-1.jpg',
                'eyebrow'  => 'What We Do',
                'title'    => 'Our Services',
                'subtitle' => 'From a single room to a complete turnkey fit-out — explore how we can bring your space to life.',
            ],
            'projects' => [
                'image'    => 'images/hero/slide-2.jpg',
                'eyebrow'  => 'Our Portfolio',
                'title'    => 'Projects',
                'subtitle' => 'A selection of residential and corporate spaces we have designed across Bangladesh.',
            ],
            'blog' => [
                'image'    => 'images/hero/slide-3.jpg',
                'eyebrow'  => 'From Our Blog',
                'title'    => 'Insights & Inspiration',
                'subtitle' => 'Tips, trends, and ideas from our interior design experts to inspire your next project.',
            ],
            'testimonials' => [
                'image'    => 'images/hero/slide-1.jpg',
                'eyebrow'  => 'Testimonials',
                'title'    => 'What Our Clients Say',
                'subtitle' => "Real words from homeowners and businesses we've designed for across Bangladesh.",
            ],
            'contact' => [
                'image'    => 'images/hero/slide-2.jpg',
                'eyebrow'  => 'Say Hello',
                'title'    => "Let's Design Your Space",
                'subtitle' => "Have a project in mind or just a question? We'd love to hear from you. Reach out below and our team will get back within one working day.",
            ],
        ]]);
    }
}
