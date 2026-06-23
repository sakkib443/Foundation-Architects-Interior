@extends('layouts.app')

@section('title', 'Blog — ' . config('app.name'))
@section('meta_description', 'Tips, trends, and ideas from Foundation Architects & Interior — insights on interior design, space planning, and the latest trends for homes and offices across Bangladesh.')

@section('content')

    {{-- ======================= PAGE HERO ======================= --}}
    @include('partials.page-hero', [
        'image'    => 'images/hero/slide-3.jpg',
        'eyebrow'  => 'From Our Blog',
        'title'    => 'Insights & Inspiration',
        'subtitle' => 'Tips, trends, and ideas from our interior design experts to inspire your next project.',
        'crumb'    => 'Blog',
    ])

    {{-- ======================= BLOG CARDS ======================= --}}
    <section class="bg-brand-50 py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-7 md:grid-cols-2 lg:grid-cols-3">
                @foreach (\App\Models\BlogPost::where('is_published', true)->orderBy('sort_order')->get() as $post)
                    @include('partials.blog-card', ['post' => $post])
                @endforeach
            </div>
        </div>
    </section>

@endsection
