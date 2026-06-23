@extends('layouts.admin')

@section('title', 'Edit team member')
@section('heading', 'Edit team member')

@section('content')
    <form method="POST" action="{{ route('admin.team.update', $team) }}" enctype="multipart/form-data" class="max-w-3xl">
        @csrf
        @method('PUT')
        @include('admin.team._form')
    </form>
@endsection
