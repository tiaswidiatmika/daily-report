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
    action="" method="post"
    class="main-page-container"
    >
        <p class="page-template-title">Buat Template Baru</p>
        <!-- template name -->
        <label for="template_name">Judul Template</label>
        <input type="text" name="template_name" id="template_name">

        <!-- Case -->
        <label for="case">Laporan</label>
        <textarea name="case" id="case"></textarea>

        <!-- Summary -->
        <label for="summary">Uraian Singkat</label>
        <textarea name="summary" id="summary"></textarea>

        <!-- Chronology -->
        <label for="chronology">Kronologis</label>
        <textarea name="chronology" id="chronology"></textarea>

        <!-- measure -->
        <label for="measure">Tindakan yang Telah Diambil</label>
        <textarea name="measure" id="measure"></textarea>

        <!-- conclusion -->
        <label for="conclusion">Kesimpulan</label>
        <textarea name="conclusion" id="conclusion"></textarea>

        <!-- button submit -->
        <button type="submit">Kirim</button>
    </form>
@endsection