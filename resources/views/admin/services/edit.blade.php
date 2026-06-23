@extends('layouts.admin')

@section('title', 'Edit service')
@section('heading', 'Edit service')

@section('content')
    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="max-w-3xl">
        @csrf
        @method('PUT')
        @include('admin.services._form')
    </form>
@endsection
