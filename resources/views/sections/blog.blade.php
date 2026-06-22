@php
    $posts = [
        [
            'title'    => 'রেস্টুরেন্ট ইন্টেরিয়র ডিজাইন যা কাস্টমার আকর্ষণ করে',
            'category' => 'Interior Design Guide',
            'date'     => '26 Apr, 2026',
            'read'     => 5,
            'image'    => 'images/blog/post-1.jpg',
            'excerpt'  => 'একটি ভালো রেস্টুরেন্ট ইন্টেরিয়র শুধু সুন্দর দেখানোর জন্য না—এটা আপনার ব্যবসার growth-এর একটি শক্তিশালী অংশ। সঠিক ডিজাইন কাস্টমারকে আকর্ষণ করে, তাদের বেশি সময় ধরে রাখে।',
        ],
        [
            'title'    => 'How to Maximize Space in a Small Apartment: 7 Smart Layout Hacks',
            'category' => 'Interior Design Guide',
            'date'     => '22 Nov, 2025',
            'read'     => 7,
            'image'    => 'images/blog/post-2.jpg',
            'excerpt'  => 'Living in a smaller footprint offers plenty of benefits — lower utility bills, less cleaning, and a naturally curated lifestyle. However, it also comes with a unique set of challenges worth solving.',
        ],
        [
            'title'    => '2026 Interior Trends: Colors, Textures & Materials to Watch',
            'category' => 'Trends & Inspiration',
            'date'     => '10 Jun, 2026',
            'read'     => 6,
            'image'    => 'images/blog/post-3.jpg',
            'excerpt'  => 'From warm earthy palettes to sustainable materials and statement lighting, here are the design directions shaping homes and offices across Bangladesh this year.',
        ],
    ];
@endphp

<section id="blog" class="bg-white py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header (centered, hero-style fonts) --}}
        <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
            <p class="font-script text-3xl leading-none text-brand-600 sm:text-4xl">From Our Blog</p>
            <h2 class="mt-3 font-display text-4xl font-bold tracking-tight text-brand-900 sm:text-5xl">
                Latest Insights
            </h2>
            <p class="mt-4 text-stone-500">
                Tips, trends, and ideas from our interior design experts to inspire your next project.
            </p>
        </div>

        {{-- Blog cards (3 columns) --}}
        <div class="mt-14 grid gap-7 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-stone-100 bg-white shadow-sm ring-1 ring-stone-900/5 transition duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-stone-900/10">

                    {{-- Image --}}
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}" loading="lazy"
                             class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        <span class="absolute left-4 top-4 inline-flex rounded-full bg-brand-600/95 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-white shadow-sm backdrop-blur">
                            {{ $post['category'] }}
                        </span>
                    </div>

                    {{-- Body --}}
                    <div class="flex flex-1 flex-col p-6">

                        {{-- Meta --}}
                        <div class="flex items-center gap-3 text-xs text-stone-400">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $post['date'] }}
                            </span>
                            <span class="h-1 w-1 rounded-full bg-stone-300"></span>
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $post['read'] }} min read
                            </span>
                        </div>

                        {{-- Title --}}
                        <h3 class="mt-3 font-display text-lg font-semibold leading-snug text-brand-900 transition group-hover:text-brand-700 line-clamp-2">
                            {{ $post['title'] }}
                        </h3>

                        {{-- Excerpt --}}
                        <p class="mt-2 text-sm leading-relaxed text-stone-500 line-clamp-3">
                            {{ $post['excerpt'] }}
                        </p>

                        {{-- Read more --}}
                        <a href="#blog" class="mt-auto inline-flex items-center gap-1.5 pt-5 text-sm font-semibold text-brand-600 transition group-hover:text-brand-800">
                            Read More
                            <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- CTA (centered) --}}
        <div class="mt-14 flex justify-center">
            <a href="#blog"
               class="group inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-brand-400 to-brand-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:from-brand-500 hover:to-brand-700">
                Read More Insights
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
