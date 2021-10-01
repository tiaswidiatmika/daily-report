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
    <form action="{{ route('report-completion', compact('report')) }}" method="post">
        @csrf
        @method('post')
        @if ( $notOnTheList->isEmpty())
            by clicking "Finish", you are wishing to complete report for: {{ $report->date }} <br>
            <button type="submit">Finish</button>
        @endif
    </form>
@endsection