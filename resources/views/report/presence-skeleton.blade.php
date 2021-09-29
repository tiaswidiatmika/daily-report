{{-- <style>
    table, tr, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style> --}}

@php
        use App\Models\{User, Position};
        $total = User::all()->where('role', '!=', 'kaunit')->count();
        $honorer = User::where('role', 'honorer')->pluck('name');
        $opis = User::where('role', 'opis')->pluck('name');
        $present = $attendees->flatten()->count() + $opis->count() + $honorer->count() + 1; // spv counted as 1
        $absent = $absentees->flatten()->count();
        $attendPos = Position::where('countAbsent', false)->get();
        $absentPos = Position::where('countAbsent', true)->get();
    @endphp

<table class="text-center w-100percent">
    <tr>
        <td>
            <p>LAPORAN ABSENSI</p>
            <p>SEKSI PEMERIKSAAN IV</p>
            <p>SELASA, 13 JULI 2021 PUKUL 05.00 - 14.00 WITA, TERMINAL KEBERANGKATAN</p>
            <hr>
        </td>
    </tr>
</table>
<table style="margin:auto;">
    <tr>
        <td>Supervisor</td>
        <td>:</td>
        <td><ol><li>{{ User::where('role', 'spv')->pluck('name')->first() }}</li></ol></td>
    </tr>
    <tr>
        <td>Asst. Supervisor</td>
        <td>:</td>
        <td>
            <ol>
        @foreach ($opis as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ol>
        </td>
    </tr>
</table>
<br>
<table class="border w-100percent">
@foreach ($attendPos as $position)
    @if ( $loop->odd )
        <tr>
    @endif
            <td>
                {{ ucwords(replaceUnderScore($position->name)) }} <br />
                <ol>
                @foreach ($attendees[$position->id] as $item)
                    <li>{{ $item->user->name }}</li>
                @endforeach
                </ol>
            </td>
    @if ($loop->even)
        </tr>
    @endif
@endforeach
    <tr>
        <td>
            Honorer:
            <ol>
                @foreach ($honorer as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </td>
    </tr>
</table>
<br>

<table style="margin-bottom:8rem;">
    <tr>
        {{-- left abssentees --}}
        <td>
            <table>
                <tr>
                    Keterangan
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>:</td>
                    <td>{{ $total }}</td>
                </tr>
                <tr>
                    <td>Hadir</td>
                    <td>:</td>
                    <td>{{ $present }}</td>
                </tr>
                <tr>
                    <td>Tidak hadir</td>
                    <td>:</td>
                    <td>{{ $absent }}</td>
                </tr>
            </table>
        </td>
        {{-- right abssentees --}}
        <td>
            <table>
                <tr>Alasan tidak hadir:</tr>
                @foreach ($absentPos as $position)
                <tr>
                    <td>{{ ucwords(replaceUnderScore($position->name)) }}</td>
                    <td>:</td>
                    <td>
                        @if ( isset($absentees[$position->id]) )
                            {{ $absentees[$position->id]->count() }}
                            <tr>
                                <td>
                                    <ol>
                                    @foreach ($absentees[$position->id] as $item)
                                        <li>{{ $item->user->name }}</li>
                                    @endforeach
                                    </ol>
                                </td>
                            </tr>
                        @else
                            0
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>