@extends('app')

@section('title')
    <title>Presence</title>
@endsection

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/create-new-template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/presence-form.css') }}">
    @livewireStyles
@endsection

@section('jsfiles')
    <script defer src="https://unpkg.com/alpinejs@3.3.2/dist/cdn.min.js"></script>
@endsection

@section('content')
    @livewire('in-duty')
    @livewireScripts
@endsection