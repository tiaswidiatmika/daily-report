@extends('app')
@section('additional-styles')
<link rel="stylesheet" href="{{ asset('css/create-new-template.css') }}">

    <style>
        .main-page-container {
            /* background: white; */
            align-self: center;
            /* margin-top: 2rem; */
            padding: 2rem;
        }
        h2 {
            margin-bottom: 0.5rem;
        }
        .selection-container {
            margin-top: 0.5rem;
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 0.5rem;
        }
        .selection {
            margin-right: 0.4rem;
            border: 1px solid var(--text-primary);
            margin-top: 0.2rem;
            padding: 0.2rem;
            border-radius: 3px;
            width: fit-content; 
        }
        .remove-selection {
            width: 1rem;
            height: 1rem;
            padding: 0;
            color: inherit;
            line-height: 1;
        }
        input[type="text"] {
            height: 1rem;
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.5rem;
            border-radius: 4px;
            border: 1px solid var(--text-primary);
        }
        /* .searchResultContainer {
            margin-top: 1rem;
        } */
        .searchResult {
            list-style: none;
            margin: 0;
            padding-top:0.5rem;
            padding-bottom:0.5rem;
            cursor: pointer;
            border: 1px solid var(--text-primary);
            padding-left: 1rem;
        }
        .searchResult li:hover {
            text-decoration: underline;
        }
    </style>
    @livewireStyles
@endsection
@section('content')
    @livewire('in-duty')
    @livewireScripts
@endsection