@extends('app')

@section('title')
    <title>Report</title>
@endsection

@section('additional-styles')
    <link rel="stylesheet" href="{{ asset('css/show-available-templates.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create-new-template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/report.css') }}">
@endsection

@section('jsfiles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" referrerpolicy="no-referrer" defer></script>
    <script src="{{ asset('/js/report.js') }}" defer></script>
    <script src="{{ asset('/js/qrcode.js') }}"></script>
@endsection

@section('content')
    <div class="main-page-container" id="main-report">
        <span class="kop-atas-container">
            <img
                class="logo-imi"
                src="{{ asset('media/logo-imigrasi.png') }}" alt="logo kecil" srcset=""
            />
            <p class="kop-samping-logo">
                Kantor Imigrasi Kelas I Khusus TPI Ngurah Rai <br />
                Bidang Tempat Pemeriksaan Imigrasi <br />
                Seksi Pemeriksaan IV <br />
            </p>
        </span>
        <span class="kop-tengah">
            <img
                class="logo-kumham"
                src="{{ asset('media/logo-kemenkumham.jpg') }}"
                alt="logo pengayom kecil" srcset=""
            />
            <p class="kop-text kop-tengah">
                <span class="kop-bold">
                    KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA <br />
                    KANTOR WILAYAH BALI <br />
                    KANTOR IMIGRASI KELAS I KHUSUS TPI NGURAH RAI <br />
                </span>
                <span>
                    Jalan Perum Taman Jimbaran No. 1 Jimbaran, Kuta Selatan, Badung, Bali <br />
                    Telepon/Faksimili: 0361-9551038,0361-8568395/0361-9357011 <br />
                    Laman: www.ngurahrai.imigrasi.go.id, Email: kanim_ngurahrai@imigrasi.go.id <br />
                </span>
            </p>
        </span>
        <p class="tujuan-surat">
            Kepada Yth. <br />
            Kepala Kantor Imigrasi <br />
            Kelas I Khusus TPI Ngurah Rai <br />
        </p>
        <h4 class="atensi-title"><u><b>LAPORAN KHUSUS / ATENSI PIMPINAN</b></u></h4>
        <table class="report-table">
            <tr class="">
                <th class="">
                    NO.
                </th>
                <th class="">
                    UNIT PEMERIKSA / <br> PERISTIWA KEJADIAN
                </th>
                <th class="">
                    URAIAN KEJADIAN
                </th>
            </tr>
    
            <tr>
                <td class="">
                    1.
                </td>
                <td class="">
                    {!! $post->case !!}
                </td>
                <td class="">
                    {!! $post->title !!}
                    <br />
    
                    {!! $post->summary !!}
                    <br />
    
                    {!! $post->chronology !!}
                    <br />
    
                    {!! $post->measure !!}  
                    <br />
    
                    {!! $post->conclusion !!}
                </td>
            </tr>
    
        </table>
        {{-- <p style="page-break-after: always;">&nbsp;</p> --}}
        <p id="qrcode" class="tujuan-surat ttd">Badung, {{ $post->tanggal_nesia }} <br />
            Kepala Seksi Pemeriksaan IV <br />
            Ahmad Ghazali <br />
            NIP. 19870303 200701 1 003
        </p>
        
        <p>
            Tembusan: <br />
            1. Kepala Bidang Tempat Pemeriksaan Imigrasi (sebagai laporan);<br />
            2. Kepala Bidang Intelijen dan Penindakan Keimigrasian;<br />
            3. Kepala Bidang Teknologi Informasi dan Komunikasi Keimigrasian
        </p>
    
        {{-- <img
            class="block"
        src="{{ asset('attachments' . '/' . $attachment->path) }}" alt="" srcset=""> --}}
    </div>
    <a id="download-btn" href="{{ route('show-pdf', ['id' => $post->id]) }}">download</a>
@endsection


    
