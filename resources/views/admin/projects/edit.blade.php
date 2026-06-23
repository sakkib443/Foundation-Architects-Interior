@extends('layouts.admin')

@section('title', 'Edit project')
@section('heading', 'Edit project')

@section('content')
    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="max-w-3xl">
        @csrf
        @method('PUT')
        @include('admin.projects._form')
    </form>
@endsection
