@extends('layouts.admin')

@section('title', 'Edit post')
@section('heading', 'Edit post')

@section('content')
    <form method="POST" action="{{ route('admin.blog.update', $blog) }}" enctype="multipart/form-data" class="max-w-3xl">
        @csrf
        @method('PUT')
        @include('admin.blog._form')
    </form>
@endsection
