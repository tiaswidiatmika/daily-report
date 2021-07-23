@extends('app')

@section('title')
    <title>New Template</title>
@endsection

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/show-available-templates.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create-new-template.css') }}">
@endsection

@section('content')

    <form
    action="{{ route('store-newly-created-template') }}" method="post"
    class="main-page-container"
    >
    @method('POST')
    @csrf
        <p class="page-title">Buat Template Baru</p>
        <!-- template name -->
        <label for="template_name">Judul Template</label>
        <input type="text" name="template_name" id="template_name" value="{{ old('template_name') }}">
        <x-alert-create-new-template attribute="template_name" />

        <!-- Case -->
        <label for="case">Laporan</label>
        <textarea name="case" id="case">{{ old('case') }}</textarea>
        <x-alert-create-new-template attribute="case" />

        <!-- Summary -->
        <label for="summary">Uraian Singkat</label>
        <textarea name="summary" id="summary">{{ old('summary') }}</textarea>
        <x-alert-create-new-template attribute="summary" />

        <!-- Chronology -->
        <label for="chronology">Kronologis</label>
        <textarea name="chronology" id="chronology">{{ old('chronology') }}</textarea>
        <x-alert-create-new-template attribute="chronology" />

        <!-- measure -->
        <label for="measure">Tindakan yang Telah Diambil</label>
        <textarea name="measure" id="measure">{{ old('measure') }}</textarea>
        <x-alert-create-new-template attribute="measure" />

        <!-- conclusion -->
        <label for="conclusion">Kesimpulan</label>
        <textarea name="conclusion" id="conclusion">{{ old('conclusion') }}</textarea>
        <x-alert-create-new-template attribute="conclusion" />
        <!-- button submit -->
        <button type="submit">Kirim</button>
    </form>
@endsection