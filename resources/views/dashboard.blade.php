@extends('app')

@section('title')
    <title>Homepage</title>
@endsection

@section('jsfiles')
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
@endsection

@section('content')
    <div class="pick-a-section-container">
        @if ( $todaysPostIsExist )
            <a class="build-report" href="menuju-ke-build-report-yang-berisi-banyak-post">Build</a>
        @endif

        <span class="main-page-title">Pick a Section</span>
        <!-- arrival section -->
        <div class="single-section-container" id="arrival-section">
            <img class="arrival-departure-icon" src="media/arrival-icon.svg" alt="" srcset="">
            <span class="section-title">Arrival<span class="chevron-right">›</span></span>
            <!-- <img class="chevron-right" src="media/chevron-left-solid.svg" alt="" srcset=""> -->
            <!-- option starts here -->
            <!-- arrival options-->
            <ul class="section-option" id="arrival-option">
                <li><a href="{{ route('create-new-template', ['ref' => 'kedatangan']) }}">Create Template</a></li>
                <li><a href="{{ route('available-templates', ['ref' => 'kedatangan']) }}">Create Post from Existing Template</a></li>
                <li>Create Blank Post</li>
            </ul>
        </div>
        <!-- departure section -->
        <div class="single-section-container" id="departure-section">
            <img class="arrival-departure-icon" src="media/departure-icon.svg" alt="" srcset="">
            <span class="section-title">Departure<span class="chevron-right">›</span></span>
            <!-- departure options -->
            <ul class="section-option" id="departure-option">
                <li><a href="{{ route('create-new-template', ['ref' => 'keberangkatan']) }}">Create Template</a></li>
                <li><a href="{{ route('available-templates', ['ref' => 'keberangkatan']) }}">Create Post from Existing Template</a></li>
                <li>Create Blank Post</li>
            </ul>
        </div>
        <!-- formation section -->
        <div class="single-section-container" id="formation-section">
            <img class="arrival-departure-icon" src="media/formation-icon.svg" alt="" srcset="">
            <span class="section-title">Formation</span>
        </div>
    </div>
        
@endsection