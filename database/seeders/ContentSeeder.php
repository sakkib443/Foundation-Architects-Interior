<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

/**
 * Seeds the collection content (services, projects, blog, testimonials) from
 * the existing config/*.php files so the public site is unchanged after the
 * switch to the database.
 */
class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $order = 0;
        foreach (config('our_services.items', []) as $slug => $s) {
            Service::updateOrCreate(['slug' => $slug], [
                'title'    => $s['title'],
                'tagline'  => $s['tagline'] ?? null,
                'icon'     => $s['icon'] ?? null,
                'image'    => $s['image'] ?? null,
                'summary'  => $s['summary'] ?? null,
                'intro'    => $s['intro'] ?? null,
                'features' => $s['features'] ?? [],
                'sort_order' => $order++,
                'is_published' => true,
            ]);
        }

        $order = 0;
        foreach (config('projects.items', []) as $slug => $p) {
            Project::updateOrCreate(['slug' => $slug], [
                'title'    => $p['title'],
                'category' => $p['category'] ?? null,
                'location' => $p['location'] ?? null,
                'year'     => $p['year'] ?? null,
                'area'     => $p['area'] ?? null,
                'image'    => $p['image'] ?? null,
                'summary'  => $p['summary'] ?? null,
                'overview' => $p['overview'] ?? null,
                'scope'    => $p['scope'] ?? [],
                'gallery'  => $p['gallery'] ?? [],
                'sort_order' => $order++,
                'is_published' => true,
            ]);
        }

        $order = 0;
        foreach (config('blog.posts', []) as $post) {
            BlogPost::updateOrCreate(['slug' => $post['slug']], [
                'title'    => $post['title'],
                'category' => $post['category'] ?? null,
                'date'     => $post['date'] ?? null,
                'read'     => $post['read'] ?? 5,
                'image'    => $post['image'] ?? null,
                'excerpt'  => $post['excerpt'] ?? null,
                'body'     => $post['body'] ?? [],
                'sort_order' => $order++,
                'is_published' => true,
            ]);
        }

        $order = 0;
        foreach (config('testimonials.items', []) as $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name'], 'role' => $t['role'] ?? null],
                [
                    'rating' => $t['rating'] ?? 5,
                    'text'   => $t['text'],
                    'sort_order' => $order++,
                    'is_published' => true,
                ]
            );
        }
    }
}
