@extends('layouts.app')

@section('title', 'About Us — ' . config('app.name'))
@section('meta_description', 'Get to know Foundation Architects & Interior — a Dhaka-based architecture & interior design studio crafting beautiful, functional spaces since 2016 with faith, honesty, and craftsmanship.')

@section('content')

    {{-- ======================= PAGE HERO ======================= --}}
    @include('partials.page-hero', array_merge([
        'image'    => 'images/hero/slide-2.jpg',
        'eyebrow'  => 'Get to Know Us',
        'title'    => 'About Foundation Architects & Interior',
        'subtitle' => 'Where vision meets craftsmanship — a studio built on faith, honesty, and a passion for designing spaces that feel like home.',
    ], $settings->get('page_heroes.about', []), ['crumb' => 'About Us']))

    {{-- ======================= SECTIONS ======================= --}}
    @include('sections.about.story')
    @include('sections.stats')
    @include('sections.about.vision-mission')
    @include('sections.about.timeline')
    @include('sections.about.founder')
    @include('sections.about.team')
    @include('sections.about.values')
    @include('sections.about.cta')

@endsection
