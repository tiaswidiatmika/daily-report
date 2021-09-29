<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if ($isStreamingPdf)
        <link rel="stylesheet" href="css/single-post.css">
    @else
        <link rel="stylesheet" href="{{ asset('/css/single-post.css') }}">
    @endif
</head>

<body>
    @foreach ($posts as $post)
        @if (!$loop->first)
            <p style="page-break-after: always;"></p>
        @endif
        @include('report.single-post-skeleton')
    @endforeach
</body>
</html>