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
add-attachments-button -> label label attachment_files


@section('content')

    <form
        class="main-page-container"
        action="{{ route('create-from-template') }}" method="post"
        enctype="multipart/form-data"
    >
        @csrf
        <p class="page-title">Laporan</p>
        @foreach ($inputNames as $input)
            <label 
                class=""
                for="{{ $input }}">{{ ucfirst($input) }}</label>
            <input 
                class=""
                type="text" name="{{ $input }}"
            >
        @endforeach

        <input type="hidden" name="ref" value="{{ $ref }}">
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