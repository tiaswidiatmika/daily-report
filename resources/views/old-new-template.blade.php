@extends('layouts.app')
@section('content')
    <form action=" {{ route('create-template') }} " method="post"
    >
    @method('POST')
    @csrf

    <div
        class="flex flex-col m-5 p-5"
    >
        <label for="template_name">Nama Template</label>
        <input
        type="text" name="template_name" id="template_name"
        class="border border-gray-400 rounded-sm"
        value="{{ old('template_name') }}"
        >
        <x-post.error-validation attribute="template_name" />


        <label for="case" class="mt-5">Laporan</label>
        <textarea name="case" id="case" cols="30" rows="10"
        class="border border-gray-400 rounded-sm resize-none"
        >{{ old('case') }}</textarea>
        <x-post.error-validation attribute="case" />

        <label for="summary" class="mt-5">Uraian Singkat</label>
        <textarea name="summary" id="summary" cols="30" rows="10">{{ old('summary') }}</textarea>
        <x-post.error-validation attribute="summary" />


        <label for="chronology" class="mt-5">Kronologis</label>
        <textarea name="chronology" id="chronology" cols="30" rows="10">{{ old('chronology') }}</textarea>
        <x-post.error-validation attribute="chronology" />


        <label for="measure" class="mt-5">Tindakan yang diambil</label>
        <textarea name="measure" id="measure" cols="30" rows="10">{{ old('measure') }}</textarea>
        <x-post.error-validation attribute="measure" />


        <label for="conclusion" class="mt-5">Kesimpulan</label>
        <textarea name="conclusion" id="conclusion" cols="30" rows="10">{{ old('conclusion') }}</textarea>
        <x-post.error-validation attribute="conclusion" />
    </div>
        {{-- <input type="hidden" name="section" value="{{ $ref }}"> --}}
        <button type="submit"
            class="px-1.5 py-1 ml-10 bg-blue-400 text-blue-50 hover:text-blue-100 hover:bg-blue-500"
        >kirim</button>

    </form>

@endsection