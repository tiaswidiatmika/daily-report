@extends('app')

@section('title')
    <title>Show Formation</title>
@endsection

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/create-new-template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/presence-form.css') }}">
@endsection

@section('content')
    <div class="main-page-container">
        @include('report.presence-skeleton')
    </div>
@endsection