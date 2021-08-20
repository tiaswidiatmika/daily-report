@extends('app')
@section('content')
    @foreach ($formation as $position => $values)
        <h1>yang di {{ $position }} adalah:</h1>
        <ul>
        @foreach ($values as $item)
            <li>{{ $item }}</li>    
        @endforeach
        </ul>
    @endforeach
@endsection