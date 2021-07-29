@if ($posts->isNotEmpty())
    @foreach ($posts as $post)
        {{ $post->section }} <br>
    @endforeach
@else
    no post yet.
@endif