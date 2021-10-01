@extends('app')

@section('title')
    <title>Show Formation</title>
@endsection

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/create-new-template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/presence-form.css') }}">


    <style>
        .user-position-not-set {
            color: red;
            font-weight: bold;
        }
        /* add width to existing class main-page-container styles*/
        .main-page-container {
            width: 80vw;
            
        }
    </style>
@endsection

@section('content')
<div class="main-page-container">
    @php
        use App\Models\{User, Position};
        $formation = json_decode( $formation, true );
        $positions = Position::all();
        $totalUser = User::where('role', 'honorer')->count() + User::where('role', 'staff')->count() + User::where('role', 'asisten_spv')->count() + User::where('role', 'spv')->count();
        $absent = 0;
        $present = 1; // initial 1, as spv already counted
        $honorer = User::where('role', 'honorer')->pluck('name');
        $present += $honorer->count();
    @endphp
    <h3>Spv</h3>
    <ol><li>{{ User::where('role', 'spv')->pluck('name')->first() }}</li></ol>

    <h3>Asst. Spv</h3>
    <ol>
        @php
            $asistenSpv = User::where('role', 'asisten_spv')->pluck('name');
            $present += $asistenSpv->count();
        @endphp
        @foreach ($asistenSpv as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ol>
    

    @foreach ($positions as $position)
        <h3>{{ $position->display_name }}</h3>
        @foreach ($formation as $formationKey => $collectionPerPosition)
            @if ( $position->id === $formationKey )
                @php
                    if ( $position->count_absent ) {
                        $absent += count( $collectionPerPosition );
                    } else {
                        $present += count( $collectionPerPosition );
                    }
                @endphp
                <ol>
                @if ( $collectionPerPosition === [] )
                    <span><i>NIHIL</i></span>
                @endif
                @foreach ($collectionPerPosition as $item)
                    @php
                        $name = User::where('alias', $item)->pluck('name')->first();
                    @endphp
                    <li>{{ $name }}</li>
                @endforeach
                </ol>
            @endif
        @endforeach
    @endforeach

    <h3>Honorer</h3>
    <ol>
        @foreach ($honorer as $user)
            <li>{{ $user }}</li>
        @endforeach
    </ol>

    <h3>Total: {{ $totalUser }}</h3>
    <h3>Hadir: {{ $present }}</h3>
    <h3>tidak adir: {{ $absent }}</h3>
    {{-- <h1>{{ $gakKerja }}</h1> --}}
    @if ( $totalUser - ( $present + $absent) > 0)
        <h3 class="user-position-not-set">gak dibolehin kerja: {{ $totalUser - $present - $absent }}</h3>
    @endif
</div>
@endsection