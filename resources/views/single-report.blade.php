<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('logo.png') }}"/>
    <style>
        /* table.border, table.border tr, table.border th, table.border td {
            border: 1px solid;
            border-collapse: collapse;
        } */
        table.border, table.border th {
            border: 1px solid;
            border-collapse: collapse;
        }
        table.border tr td {
            border-top: none;
            border-bottom: none;
            border-left: 1px solid;
            border-right: 1px solid;
        }
        table.border tr td table tr td {
            border: none;
        }
        table.border td {
            padding: 0.5rem;
        }
        table.border table.no-border {
            border-left: none;
        }
        table.no-border tr, table.no-border td {
            border: none;
            padding: 0.2rem;
        }
        /* table.border tr:not(:first-child) td table tr td {
            border: none;
        } */
        .border-bottom {
            border-bottom: 2px solid;
            padding-bottom: 2px;
        }
        .logo-sm {
            width: 3rem;
            height: 3rem;
        }
        .font-sm {
            font-size: 0.7rem;
        }
        .text-bold {
            font-weight: 700;
        }
        .text-center {
            text-align: center;
        }
        .text-md {
            font-size: 0.8rem;
        }
        .float-left {
            margin-left: 25rem;
        }
    </style>
    <title>Single Report</title>
</head>
<body>
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

    <p class="text-bold text-center">
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

    <table class="border">
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
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td>12:69 - 69:12 WIN</td>
                    </tr>
                    <tr>
                        <td>Tempat</td>
                        <td>:</td>
                        <td>{{ $post->section }}</td>
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
    <p style="page-break-after: always;">
    
</body>
</html>