@php
    $posts = \App\Models\BlogPost::where('is_published', true)->orderBy('sort_order')->take(3)->get();
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
                @include('partials.blog-card', ['post' => $post])
            @endforeach
        </div>

        {{-- CTA (centered) --}}
        <div class="mt-14 flex justify-center">
            <a href="{{ route('blog') }}"
               class="group inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-brand-400 to-brand-600 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-brand-500/30 transition hover:from-brand-500 hover:to-brand-700">
                Read More Insights
                <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
