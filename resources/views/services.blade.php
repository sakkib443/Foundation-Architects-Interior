@extends('layouts.app')

@section('title', 'Services — ' . config('app.name'))
@section('meta_description', 'Explore the interior design services offered by Foundation Architects & Interior — residential design, commercial interiors, modular kitchens, 3D visualization and full turnkey projects.')

@section('content')

    {{-- ======================= PAGE HERO ======================= --}}
    @include('partials.page-hero', [
        'image'    => 'images/hero/slide-1.jpg',
        'eyebrow'  => 'What We Do',
        'title'    => 'Our Services',
        'subtitle' => 'From a single room to a complete turnkey fit-out — explore how we can bring your space to life.',
        'crumb'    => 'Services',
    ])

    {{-- ======================= SERVICE CARDS ======================= --}}
    <section class="bg-brand-50 py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-7 md:grid-cols-2 lg:grid-cols-3">
                @foreach (\App\Models\Service::where('is_published', true)->orderBy('sort_order')->get() as $service)
                    @include('partials.service-card', ['slug' => $service->slug, 'service' => $service])
                @endforeach
            </div>
        </div>
    </section>

@endsection
