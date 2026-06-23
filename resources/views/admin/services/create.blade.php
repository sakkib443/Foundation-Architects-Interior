@extends('layouts.admin')

@section('title', 'Add service')
@section('heading', 'Add service')

@section('content')
    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="max-w-3xl">
        @csrf
        @include('admin.services._form')
    </form>
@endsection
