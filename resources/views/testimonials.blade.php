@extends('layouts.app')

@section('title', 'Testimonials — ' . config('app.name'))
@section('meta_description', 'Read what our clients say about Foundation Architects & Interior — real words from homeowners and businesses we have designed for across Bangladesh.')

@section('content')

    {{-- ======================= PAGE HERO ======================= --}}
    @include('partials.page-hero', array_merge([
        'image'    => 'images/hero/slide-1.jpg',
        'eyebrow'  => 'Testimonials',
        'title'    => 'What Our Clients Say',
        'subtitle' => "Real words from homeowners and businesses we've designed for across Bangladesh.",
    ], $settings->get('page_heroes.testimonials', []), ['crumb' => 'Testimonials']))

    {{-- ======================= TESTIMONIAL CARDS ======================= --}}
    <section class="bg-brand-50 py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-7 md:grid-cols-2 lg:grid-cols-3">
                @foreach (\App\Models\Testimonial::where('is_published', true)->orderBy('sort_order')->get() as $t)
                    @include('partials.testimonial-card', ['t' => $t])
                @endforeach
            </div>
        </div>
    </section>

@endsection
