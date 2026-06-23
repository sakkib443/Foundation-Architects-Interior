@extends('layouts.admin')

@section('title', 'Add team member')
@section('heading', 'Add team member')

@section('content')
    <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data" class="max-w-3xl">
        @csrf
        @include('admin.team._form')
    </form>
@endsection
