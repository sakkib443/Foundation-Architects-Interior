@extends('layouts.admin')

@section('title', 'Edit testimonial')
@section('heading', 'Edit testimonial')

@section('content')
    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" class="max-w-3xl">
        @csrf
        @method('PUT')
        @include('admin.testimonials._form')
    </form>
@endsection
