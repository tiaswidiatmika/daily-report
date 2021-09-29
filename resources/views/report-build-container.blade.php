@extends('app')

@section('title')
    {{-- <title>{{ $report->date }} Report</title> --}}
@endsection

@section('jsfiles')
    <script defer src="https://unpkg.com/alpinejs@3.3.4/dist/cdn.min.js"></script>
@endsection

@section('content')
{{-- {{ dd($reportSections) }} --}}
    @php
        $prop = $reportSections['formations']->isNotEmpty()  ?
            'checked' : 'disabled';
    @endphp
    {{-- section for presence --}}
    <form action="{{ route('combine-report') }}">
        @csrf
        @method('post')
    <h3>Laporan Kehadiran</h3>

    <ul>
        <li>
            <label for="presence">
                <a href="{{ route('create-presence') }}">Absensi Tanggal: {{ $report->date }}</a>
                <input
                    type="checkbox"
                    name="presence"
                    id="presence"
                    {{ $prop }}
                >
            </label>
        </li>
    </ul>
    <h3>Laporan Harian</h3>
    <ul>
        @foreach ($reportSections['posts'] as $post)
            <li>
                <label for="post.{{ $post->id }}">
                    <a href="{{ route('show-post', ['id' => $post->id]) }}" target="_blank">{{ $post->title }}</a>
                    <input
                        class="postsCheckbox"
                        type="checkbox"
                        name="posts[]"
                        value={{ $post->id }}
                        checked
                    >
                </label>
            </li>
        @endforeach
    </ul>
    <button type="submit">sumbit</button>
    </form>
    

    <script>
        let postsCheckboxes = document.querySelectorAll('input.postsCheckbox[type="checkbox"]');
        postsCheckboxes.forEach( postsCheckbox =>
            postsCheckbox.addEventListener('change', function () {
                let checked = document.querySelectorAll('input.postsCheckbox[type="checkbox"]:checked');
                if (checked.length == 0) {
                    this.checked = true;
                }
            })
        );

        // prevent presence checkbox being modified
        let presenceCheckbox = document.querySelector('#presence').addEventListener('change', function () {
            this.checked = true;
        });
    </script>

@endsection