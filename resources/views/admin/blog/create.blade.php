@extends('layouts.admin')

@section('title', 'Write post')
@section('heading', 'Write post')

@section('content')
    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" class="max-w-3xl">
        @csrf
        @include('admin.blog._form')
    </form>
@endsection
