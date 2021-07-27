@props(['attribute'])
@error($attribute)
    <ul class="alert-text danger">
        @foreach ($errors->get($attribute) as $error)
            @if (is_array($error))
                @foreach ($error as $subError)
                    <li>{{ $subError }}</li>
                @endforeach
            @else
                <li>{{ $error }}</li>
            @endif
        @endforeach
    </ul>
@enderror