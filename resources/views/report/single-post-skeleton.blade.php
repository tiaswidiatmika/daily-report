<table class="no-border">
    <tr>
        <td>
            @if ($isStreamingPdf)
            <img src="media/logo-kemenkumham.jpg" alt="" class="logo-sm">
            @else
                <img src="/media/logo-kemenkumham.jpg" alt="" class="logo-sm">
            @endif
        </td>
            @if ($isStreamingPdf)
                <td><img class="logo-sm" src="media/logo-imigrasi.png" alt="logo ini" srcset=""></td>
            @else
                <td><img class="logo-sm" src="/media/logo-imigrasi.png" alt="logo ini" srcset=""></td>
            @endif
        <td>
            <p class="font-sm">
                Kantor Imigrasi Kelas I Khusus TPI Ngurah Rai<br>
                Bidang Tempat Pemeriksaan Imigrasi<br>
                Seksi Pemeriksaan IV
            </p>
        </td>
    </tr>
</table>

<p class="text-bold text-center w-100percent">
    KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA<br>
    KANTOR WILAYAH BALI<br>
    KANTOR IMIGRASI KELAS I KHUSUS TPI NGURAH RAI
</p>
<p class="text-center text-md border-bottom w-100percent">
    Jalan Perum Taman Jimbaran No. 1 Jimbaran, Kuta Selatan, Badung, Bali<br>
    Telepon/Faksimili: 0361-9551038,0361-8568395/0361-9357011<br>
    Laman: www.ngurahrai.imigrasi.go.id, Email: kanim_ngurahrai@imigrasi.go.id<br>
</p>
<p class="float-right">
    Kepada Yth.<br>
    Kepala Kantor Imigrasi<br>
    Kelas I Khusus TPI Ngurah Rai
</p>

<p class="text-center w-100percent"><b><u>LAPORAN KHUSUS / ATENSI PIMPINAN</u></b></p>

<table class="border w-100percent">
    <tr>
        <th>No.</th>
        <th>
            UNIT PEMERIKSA / <br>PERISTIWA KEJADIAN 
        </th>
        <th>URAIAN KEJADIAN</th>
    </tr>
    {{-- first row --}}
    <tr>
        <td>1.</td>
        <td>{!! $post->case !!}</td>
        <td>
            <table class="no-border">
                <tr>
                    <td>Hari / Tanggal</td>
                    <td>:</td>
                    <td>{!! $post->date !!}</td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td>{!! $post->time !!}</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>{!! ucfirst($post->section) !!}</td>
                </tr>   
            </table>
        </td>
    </tr>
    {{-- second row --}}
    <tr>
        <td></td>
        <td></td>
        <td>
            <b><u>Uraian Singkat Kejadian:</u></b><br>
            <p>
                {!! $post->summary !!}
            </p>
        </td>
    </tr>
    {{-- third row --}}
    <tr>
        <td></td>
        <td></td>
        <td>
            <b><u>Kronologis:</u></b><br>
            <p>
                {!! $post->chronology !!}
            </p>
        </td>
    </tr>
    {{-- fourth row --}}
    <tr>
        <td></td>
        <td></td>
        <td>
            <b><u>Tindakan yang telah diambil:</u></b><br>
            <p>
                    {!! $post->measure !!}
            </p>
        </td>
    </tr>
    {{-- fifth row --}}
    <tr>
        <td></td>
        <td></td>
        <td>
            <b><u>Kesimpulan</u></b><br>
            <p>
                {!! $post->conclusion !!}
            </p>
        </td>
    </tr>
</table>
<p class="float-right">
    {{ $post->date }} <br />
    Kepala Seksi Pemeriksaan IV
    <br>
    @if ($isStreamingPdf)
        <img class="block" src='qrcode/{{ $post->qrcode }}' alt="" style="width: 100px;"><br>
    @else
        <img class="block" src='/qrcode/{{ $post->qrcode }}' alt="" style="width: 100px;"><br>
    @endif
    @php
        $kaunit = teammatesWithRole( $post->report->division->users, 'kaunit' )->first();
    @endphp
    {{ $kaunit->name }} <br />
    NIP. {{ $kaunit->nip }} <br />
</p>

<p class="">
    Tembusan: <br />
    1. Kepala Bidang Tempat Pemeriksaan Imigrasi (sebagai laporan);<br />
    2. Kepala Bidang Intelijen dan Penindakan Keimigrasian;<br />
    3. Kepala Bidang Teknologi Informasi dan Komunikasi Keimigrasian
</p>
{{-- attachment --}}
@if ($post->attachments->isNotEmpty())
    {{-- <p style="page-break-after: always;"></p> --}}
    <table class="w-100percent">
    <tr>
        <td><p class=""><b><u>{{ strtoupper( $post->attachments->first()->title ) }}</u></b></p></td>
    </tr>    
    @foreach ($post->attachments as $item)
        @if ($isStreamingPdf)
            <tr><td class="text-center"><img class="max-w-80percent block text-center margin-top-2" src='attachments/{{ $item->path }}' alt="" srcset=""> </td></tr>
        @else
            @if ( !isset($renderedFromSeeder) )
                <tr>
                    <td class="text-center"><img class="max-w-80percent block text-center margin-top-2" src='{{ $item->path }}' alt="" srcset=""></td>
                </tr>
            @endif
            <tr><td class="text-center"><img class="max-w-80percent block text-center margin-top-2" src='/attachments/{{ $item->path }}' alt="" srcset=""> </td></tr>
        @endif
    @endforeach

    </table>
@endif
