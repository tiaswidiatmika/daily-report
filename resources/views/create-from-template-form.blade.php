@extends('app')

@section('title')
    <title>Create From Template</title>
@endsection

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/show-available-templates.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create-new-template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create-from-template-form.css') }}">
@endsection

@section('jsfiles')
    <script src="{{ asset('js/create-from-template-form.js') }}" defer></script>
@endsection

@section('content')

    <form
        class="main-page-container"
        action="{{ route('store-post-from-template', ['id' => $id]) }}" method="post"
        enctype="multipart/form-data"
    >
        @csrf
        <p class="page-title">Laporan</p>
        @foreach ($inputNames as $input)
            <label 
                class=""
                for="{{ $input }}">{{ ucwords( replaceUnderScore($input) ) }}</label>
            <input 
                class=""
                type="text" name="{{ str_replace(' ', '_', $input) }}"
                value="{{ old( str_replace(' ', '_', $input) ) }}"
            >
            <x-alert-validate-request attribute="{{ str_replace(' ', '_', $input) }}" />
        @endforeach
        <label 
                class=""
                for="date">Tanggal</label>
            <input 
                class=""
                type="text" name="date"
                value="{{ now()->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y') }}"
        >
        <label 
                class=""
                for="time">Waktu</label>
            <input 
                class=""
                type="text" name="time"
                value="{{ now('Asia/Shanghai')->locale('id')->format('h:i') . ' - ' . now('Asia/Shanghai')->locale('id')->addHour(1)->format('h:i') . ' WITA'}}"
        >
        <label 
                class=""
                for="ref">Section</label>
            <input 
                class=""
                type="text" name="ref"
                value="{{ 'Terminal ' . ucfirst( $ref ) . ' Bandar Udara Ngurah Ray' }}"
        >
        <input type="hidden" name="templateId" value="{{ $template->id }}">

        {{-- add attachments start --}}
        <button id="add-attachments-button">Tambah Lampiran Foto</button>
        <span id="attachment-group">
            <label 
            class=""
            for="attachment_title">attachment title</label>
            <input 
                class=""
                type="text" name="attachment_title"
            >
            <label 
                class=""
                for="image[]">add photo</label>
            <input
                id="attachment_files"
                type="file"
                class=""
                name="image[]"
                multiple
            >
        </span>
        {{-- add attachments end --}}

        <button type="submit"
            class=""
        >Kirim</button>
    </form>
@endsection