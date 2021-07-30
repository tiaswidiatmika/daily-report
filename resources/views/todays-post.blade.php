<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p><b><u>Report for Today</u></b></p>
    @if ($posts->isNotEmpty())
        @foreach ($posts as $post)
            {{ $post->section }} <br>
        @endforeach
    @else
        no post yet.
    @endif

    <button>build report</button>
</body>
</html>
