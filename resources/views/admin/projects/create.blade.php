@extends('layouts.admin')

@section('title', 'Add project')
@section('heading', 'Add project')

@section('content')
    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="max-w-3xl">
        @csrf
        @include('admin.projects._form')
    </form>
@endsection
