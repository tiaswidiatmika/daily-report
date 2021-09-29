@extends('app')
@section('title')
    <title>Combined Report</title>
@endsection

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/single-post.css') }}">
@endsection

@section('content')
    @include('report.presence-skeleton')
    @foreach ($posts as $post)
        @include('report.single-post-skeleton')
    @endforeach
@endsection