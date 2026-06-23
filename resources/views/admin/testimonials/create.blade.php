@extends('layouts.admin')

@section('title', 'Add testimonial')
@section('heading', 'Add testimonial')

@section('content')
    <form method="POST" action="{{ route('admin.testimonials.store') }}" class="max-w-3xl">
        @csrf
        @include('admin.testimonials._form')
    </form>
@endsection
