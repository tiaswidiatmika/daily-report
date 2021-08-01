<table class="no-border">
    <tr>
        <td>
            <img src="media/logo-kemenkumham.jpg" alt="" class="logo-sm">
        </td>
        <td><img class="logo-sm" src="media/logo-imigrasi.png" alt="logo ini" srcset=""></td>
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
<p class="text-center text-md border-bottom">
    Jalan Perum Taman Jimbaran No. 1 Jimbaran, Kuta Selatan, Badung, Bali<br>
    Telepon/Faksimili: 0361-9551038,0361-8568395/0361-9357011<br>
    Laman: www.ngurahrai.imigrasi.go.id, Email: kanim_ngurahrai@imigrasi.go.id<br>
</p>
<p class="float-left">
    Kepada Yth.<br>
    Kepala Kantor Imigrasi<br>
    Kelas I Khusus TPI Ngurah Rai
</p>

<p class="text-center"><b><u>LAPORAN KHUSUS / ATENSI PIMPINAN</u></b></p>

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
        <td>{{ $post->case }}</td>
        <td>
            <table class="no-border">
                <tr>
                    <td>Hari / Tanggal</td>
                    <td>:</td>
                    <td>{{ $post->date }}</td>
                </tr>
                <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td>{{ $post->time }}</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>{{ ucfirst($post->section) }}</td>
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
                {{ $post->summary }}
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
                {{ $post->chronology }}
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
                {{ $post->measure }}
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
                {{ $post->conclusion }}
            </p>
        </td>
    </tr>
</table>
<p style="margin-left: 10cm;">
    {{ $post->date }} <br />
    Kepala Seksi Pemeriksaan IV
    <br>
    <img class="block" src='qrcode/{{ $post->qrcode }}' alt="" style="width: 100px;"><br>
    Ahmad Ghazali <br />
    NIP. 19870303 200701 1 003 <br />
</p>

<p class="">
    Tembusan: <br />
    1. Kepala Bidang Tempat Pemeriksaan Imigrasi (sebagai laporan);<br />
    2. Kepala Bidang Intelijen dan Penindakan Keimigrasian;<br />
    3. Kepala Bidang Teknologi Informasi dan Komunikasi Keimigrasian
</p>