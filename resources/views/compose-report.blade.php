<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>compose report</title>
</head>
<body>
    @foreach ($posts as $post)
        {{ $loop->iteration }}. Post title : {{ $post->section }} <br>
        @foreach ($post->attachments as $attachment)
            attachment : {{ $attachment->title}} <br>
        @endforeach
        qrcode: {{ $post->qrcode }}
        <br>
    @endforeach
</body>
</html>