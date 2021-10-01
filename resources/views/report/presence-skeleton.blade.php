@php
        use App\Models\{User, Position};
        $exceptKaunit = User::ofRole('exceptKaunit')->get();
        $total = $exceptKaunit->count();
        $honorer = User::ofRole('honorer')->pluck('name');
        $asistenSpv = User::ofRole('asisten_spv')->pluck('name');
        $present = $attendees->flatten()->count();
        $absent = $absentees->flatten()->count();
        $attendPos = Position::typePresent()->get()
            ->whereNotIn('id', Position::exemptedFromReport());
        $absentPos = Position::typeAbsent()->get();
        
        $notOnTheList = $exceptKaunit->pluck('id')
            ->diff( $onTheList );
        $notOnTheList = $notOnTheList->map( function( $id ) {
            return User::find($id)->name;
        } );
    @endphp

<table class="text-center w-100percent">
    <tr>
        <td>
            <p>LAPORAN ABSENSI</p>
            <p>SEKSI PEMERIKSAAN IV</p>
            <p>{{ $report->date }} PUKUL 05.00 - 14.00 WITA, TERMINAL KEBERANGKATAN</p>
            <hr>
        </td>
    </tr>
</table>
<table style="margin:auto;">
    <tr>
        <td>Supervisor</td>
        <td>:</td>
        <td><ol><li>{{ User::ofRole('spv')->pluck('name')->first() }}</li></ol></td>
    </tr>
    <tr>
        <td>Asst. Supervisor</td>
        <td>:</td>
        <td>
            <ol>
        @foreach ($asistenSpv as $item)
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
                {{ ucwords(replaceUnderScore($position->name)) }}: <br />
                <ol>
                    @if ( isset($attendees[$position->id]) )
                        @foreach ($attendees[$position->id] as $item)
                            <li>{{ $item->user->name }}</li>
                        @endforeach
                    @else
                        <h3>—</h3>
                    @endif
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

<table style="margin-bottom:8rem; margin-top:2rem;" class="w-100percent">
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
    @if ( $notOnTheList->isNotEmpty() )
        <tr>
            <td>
                <h4>BELUM MASUK DALAM DAFTAR ABSENSI</h4>
                <ol>
                    @foreach ($notOnTheList as $item)
                        <li style="color:red;">{{ $item }}</li>
                    @endforeach
                </ol>
            </td>
        </tr>
    @endif
        
</table>