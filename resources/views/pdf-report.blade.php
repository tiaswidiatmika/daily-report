<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    .flex {
      display: flex;
    }

    .block {
      display: block;
    }

    .w-full {
      width: 100%;
    }

    .text-center {
      text-align: center;
    }

    .font-bold {
      font-weight: 700;
    }

    .underline {
      text-decoration: underline;
    }

    table.table-border,
    .table-border th,
    .table-border td {
      border: 1px solid;
      border-collapse: collapse;
    }

    table.page-break,
    .page-break tr,
    .page-break td,
      {
      page-break-inside: auto;
    }
  </style>
</head>

<body>

  <table class="w-full">
    <tr>
      <td style="width: 80px;">
        <img class="block w-full" src="media/logo-imigrasi.png" alt="logo kecil" width="120px" />
      </td>
      <td>
        <p>
          Kantor Imigrasi Kelas I Khusus TPI Ngurah Rai <br />
          Bidang Tempat Pemeriksaan Imigrasi <br />
          Seksi Pemeriksaan IV
        </p>
      </td>
      <td style="width: 80px;">
        <img class="block w-full" src="media/logo-kemenkumham.jpg" alt="logo pengayom kecil" srcset="" />
      </td>
    </tr>
  </table>

  <p class="text-center font-bold">
    KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA <br />
    KANTOR WILAYAH BALI <br />
    KANTOR IMIGRASI KELAS I KHUSUS TPI NGURAH RAI
  </p>
  <p class="text-center">
    Jalan Perum Taman Jimbaran No. 1 Jimbaran, Kuta Selatan, Badung, Bali <br />
    Telepon/Faksimili: 0361-9551038,0361-8568395/0361-9357011 <br />
    Laman: www.ngurahrai.imigrasi.go.id, Email: kanim_ngurahrai@imigrasi.go.id
  </p>

  <hr>

  <p style="margin-left: 10cm;">
    Kepada Yth. <br />
    Kepala Kantor Imigrasi <br />
    Kelas I Khusus TPI Ngurah Rai <br />
  </p>

  <p class="text-center font-bold underline">LAPORAN KHUSUS / ATENSI PIMPINAN</p>

  <table class="w-full table-border">
    <thead>
      <tr>
        <th>NO.</th>
        <th>UNIT PEMERIKSA / <br> PERISTIWA KEJADIAN</th>
        <th>URAIAN KEJADIAN</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1.</td>
        <td>{!! $post->case !!}</td>
        <td>

          {!! $post->summary !!}
          <br />

          {!! $post->chronology !!}
          <br />

          {!! $post->measure !!}
          <br />

          {!! $post->conclusion !!}
        </td>
      </tr>
    </tbody>
  </table>

  <p style="margin-left: 10cm;">
    Badung, {{ $post->tanggal_nesia }} <br />
    Kepala Seksi Pemeriksaan IV <br />
    <br>
    <img class="block" src="{{ $qr }}" alt="" style="width: 100px;">
    Ahmad Ghazali <br />
    NIP. 19870303 200701 1 003 <br />
  </p>

  <p>
    Tembusan: <br />
    1. Kepala Bidang Tempat Pemeriksaan Imigrasi (sebagai laporan);<br />
    2. Kepala Bidang Intelijen dan Penindakan Keimigrasian;<br />
    3. Kepala Bidang Teknologi Informasi dan Komunikasi Keimigrasian
  </p>

</body>

</html>