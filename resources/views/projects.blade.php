@extends('layouts.app')

@section('title', 'Projects — ' . config('app.name'))
@section('meta_description', 'Browse the portfolio of Foundation Architects & Interior — residential and corporate interior design projects delivered across Dhaka and Bangladesh.')

@section('content')

    {{-- ======================= PAGE HERO ======================= --}}
    @include('partials.page-hero', [
        'image'    => 'images/hero/slide-2.jpg',
        'eyebrow'  => 'Our Portfolio',
        'title'    => 'Projects',
        'subtitle' => 'A selection of residential and corporate spaces we have designed across Bangladesh.',
        'crumb'    => 'Projects',
    ])

    {{-- ======================= PROJECT CARDS ======================= --}}
    <section class="bg-brand-50 py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (\App\Models\Project::where('is_published', true)->orderBy('sort_order')->get() as $project)
                    @include('partials.project-card', ['slug' => $project->slug, 'project' => $project])
                @endforeach
            </div>
        </div>
    </section>

@endsection
