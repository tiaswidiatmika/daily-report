@extends('app')

@section('title')
    <title>Single Report</title>
@endsection

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('/css/single-post.css') }}">
@endsection

@section('content')
    @include('report.single-post-skeleton')
@endsection