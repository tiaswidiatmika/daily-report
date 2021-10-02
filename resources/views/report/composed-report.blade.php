@extends('app')
@section('title')
    <title>Combined Report</title>
@endsection

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/single-post.css') }}">
@endsection

@section('content')
    {{-- @include('report.presence-skeleton')
    @foreach ($posts as $post)
        @include('report.single-post-skeleton')
    @endforeach
    <br><br> --}}
    <form action="{{ route('report-finish', compact('report')) }}" method="post">
        @csrf
        @method('post')
        <input type="hidden" name="posts" value="{{ $posts->pluck('id')->toJson() }}">
        @if ( $notOnTheList->isEmpty())
            by clicking "Finish", you are wishing to complete report for: {{ $report->date }} <br>
            <button type="submit">Finish</button>
        @else
            please make sure all staff are included on the presence list
        @endif
    </form>
@endsection