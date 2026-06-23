<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Services offered
    |--------------------------------------------------------------------------
    |
    | Single source of truth for the /services listing and each
    | /services/{slug} detail page. Icons are Heroicons "outline" path data.
    | (Named "our_services" to avoid clashing with Laravel's config/services.php.)
    |
    */

    'items' => [

        'residential-design' => [
            'title'    => 'Residential Design',
            'tagline'  => 'Homes that feel like you',
            'icon'     => 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.5a.75.75 0 00.75.75h3.75v-6a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v6h3.75a.75.75 0 00.75-.75V9.75M8.25 21h8.25',
            'image'    => 'images/portfolio/project-1.jpg',
            'summary'  => 'Full-home interiors for apartments and houses — from cosy living rooms to functional bedrooms, designed around how you actually live.',
            'intro'    => 'Your home should tell your story. We design residential interiors that balance beauty and everyday function — thoughtful layouts, warm materials, and details that make a space truly yours. Whether it is a compact apartment or a full house, we handle everything from the first concept to the final styled room.',
            'features' => [
                ['title' => 'Space planning', 'text' => 'Smart layouts that make every square foot count, tailored to your routine.'],
                ['title' => 'Material & colour', 'text' => 'Curated palettes, finishes and textures that feel cohesive and timeless.'],
                ['title' => 'Custom furniture', 'text' => 'Bespoke wardrobes, beds and storage built to fit your space perfectly.'],
                ['title' => 'Styling & handover', 'text' => 'Lighting, décor and finishing touches for a move-in-ready home.'],
            ],
        ],

        'commercial-interior' => [
            'title'    => 'Commercial Interior',
            'tagline'  => 'Spaces that work as hard as you do',
            'icon'     => 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21',
            'image'    => 'images/portfolio/project-3.jpg',
            'summary'  => 'Offices, cafés, showrooms and retail spaces designed to impress clients, support your team, and reflect your brand.',
            'intro'    => 'Great commercial spaces do more than look good — they help your business perform. We design offices, cafés, retail and hospitality interiors that strengthen your brand, improve workflow, and make people want to stay. Every decision is balanced against durability, budget and timeline.',
            'features' => [
                ['title' => 'Brand-led design', 'text' => 'Interiors that express your identity the moment someone walks in.'],
                ['title' => 'Functional layouts', 'text' => 'Flow and zoning planned around staff, customers and operations.'],
                ['title' => 'Durable materials', 'text' => 'Finishes chosen to handle heavy footfall and daily wear.'],
                ['title' => 'On-time delivery', 'text' => 'Phased execution that keeps your business running with minimal downtime.'],
            ],
        ],

        'modular-kitchen' => [
            'title'    => 'Modular Kitchen',
            'tagline'  => 'The heart of the home, perfected',
            'icon'     => 'M3.75 6A2.25 2.25 0 016 3.75h12A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6zM3.75 9h16.5M9 3.75v16.5',
            'image'    => 'images/portfolio/project-2.jpg',
            'summary'  => 'Ergonomic, easy-to-clean modular kitchens with smart storage and premium finishes built for Bangladeshi cooking.',
            'intro'    => 'A kitchen should make cooking effortless and joyful. Our modular kitchens are engineered around the work triangle, with moisture-resistant materials, intelligent storage and hardware that lasts. We design for real, everyday cooking — not just for the photos.',
            'features' => [
                ['title' => 'Ergonomic layout', 'text' => 'Counters, sink and stove placed for a smooth, fatigue-free workflow.'],
                ['title' => 'Smart storage', 'text' => 'Tall units, pull-outs and corner solutions that use every inch.'],
                ['title' => 'Quality hardware', 'text' => 'Soft-close hinges and channels rated for years of daily use.'],
                ['title' => 'Easy maintenance', 'text' => 'Water-resistant, wipe-clean surfaces suited to local cooking.'],
            ],
        ],

        '3d-visualization' => [
            'title'    => '3D Visualization',
            'tagline'  => 'See it before it is built',
            'icon'     => 'M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9',
            'image'    => 'images/hero/slide-3.jpg',
            'summary'  => 'Photorealistic 3D renders and walkthroughs so you can experience your space — and approve every detail — before work begins.',
            'intro'    => 'No more guessing from flat drawings. We turn your design into photorealistic 3D visuals and walkthroughs, so you can see materials, lighting and layout exactly as they will be. It removes surprises, speeds up decisions, and makes sure the finished space matches the vision.',
            'features' => [
                ['title' => 'Photorealistic renders', 'text' => 'High-detail images of every key view of your space.'],
                ['title' => 'Material previews', 'text' => 'Compare finishes, colours and lighting before committing.'],
                ['title' => 'Walkthrough videos', 'text' => 'Animated tours that let you move through the design.'],
                ['title' => 'Faster approvals', 'text' => 'Clear visuals that make sign-off quick and confident.'],
            ],
        ],

        'turnkey-projects' => [
            'title'    => 'Turnkey Projects',
            'tagline'  => 'One team, from key to keys',
            'icon'     => 'M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z',
            'image'    => 'images/portfolio/project-4.jpg',
            'summary'  => 'A complete, hassle-free package — design, materials, execution and handover managed end-to-end by a single accountable team.',
            'intro'    => 'Want a finished space without juggling contractors? Our turnkey service takes full ownership — design, procurement, civil work, fit-out and final styling — under one roof. You get a single point of contact, a fixed scope, and a beautifully finished space handed over ready to use.',
            'features' => [
                ['title' => 'End-to-end delivery', 'text' => 'Design through execution managed by one accountable team.'],
                ['title' => 'Transparent budgeting', 'text' => 'Clear, itemised costs with no hidden surprises.'],
                ['title' => 'Quality control', 'text' => 'Supervised workmanship and materials at every stage.'],
                ['title' => 'Ready handover', 'text' => 'A fully finished, styled space delivered on schedule.'],
            ],
        ],

    ],

];
