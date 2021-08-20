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
            <a class="build-report" href="{{ route('todays-report') }}">Build</a>
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
                <a href="{{ route('create-new-template', ['ref' => 'kedatangan']) }}"><li>Create Template</li></a>
                <a href="{{ route('available-templates', ['ref' => 'kedatangan']) }}"><li>Create Post from Existing Template</li></a>
                <li>Create Blank Post</li>
            </ul>
        </div>
        <!-- departure section -->
        <div class="single-section-container" id="departure-section">
            <img class="arrival-departure-icon" src="media/departure-icon.svg" alt="" srcset="">
            <span class="section-title">Departure<span class="chevron-right">›</span></span>
            <!-- departure options -->
            <ul class="section-option" id="departure-option">
                <a href="{{ route('create-new-template', ['ref' => 'keberangkatan']) }}"><li>Create Template</li></a>
                <a href="{{ route('available-templates', ['ref' => 'keberangkatan']) }}"><li>Create Post from Existing Template</li></a>
                <li>Create Blank Post</li>
            </ul>
        </div>
        <!-- formation section -->
        <a href="{{ route('create-presence') }}">
            <div class="single-section-container" id="formation-section">
                <img class="arrival-departure-icon" src="media/formation-icon.svg" alt="" srcset="">
                <span class="section-title">Formation</span>
            </div>
        </a>
    </div>
        
@endsection