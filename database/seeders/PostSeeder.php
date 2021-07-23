<?php

namespace Database\Seeders;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = strtoupper(Carbon::parse(Carbon::now()->locale('id'))->format('D, d F Y'));
        // protected $fillable = ['user_id','title', 'case', 'summary', 'chronology', 'measure', 'conclusion'];
        Post::create([
            'section' => 'arrival',
            'user_id' => 1,
            'title' =>
                "<table>
                    <tr>
                    <td>Hari / Tanggal</td>
                    <td>:</td>
                    <td class='p-1'></td>
                    </tr>
                
                    <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td class='p-1'>{$date}</td>
                    </tr>
                
                    <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td class='p-1'>Keberangkatan Internasional
                    TPI Ngurah Rai</td>
                    </tr>
                </table>",
            'case' => "
                <p>Telah dilakukan
                Pengawasan
                Keberangkatan terhadap 3
                (Tiga) orang kru stay on
                board Pesawat CI 2771
                dengan rute penerbangan
                Denpasar-Taipei</p>",
            'summary' => "
                <p>
                    <b><u>Uraian Singkat Kejadian: </u></b>
                </p>
                <p>Bahwa, pada hari, tanggal tersebut di atas dilakukan Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei</p>

            ",
            'chronology' => "
                <p>
                    <b><u>Kronologis: </u></b>
                </p>
                <p>Pengawasan Keberangkatan terhadap 3 (Tiga) orang
                kru stay on board Pesawat CI 2771 dengan rute
                penerbangan Denpasar-Taipei dilakukan pada pukul
                13.40 WITA</p>",
            'measure' => "
                <p>
                    <b><u>Tindakan yang telah diambil: </u></b>
                </p>
                <p>Melaporkan kejadian tersebut pada pimpinan</p>",
            'conclusion' => "
                <p>
                    <b><u>Kesimpulan: </u></b>
                </p>
                <p>Bahwa telah dilakukan Pengawasan Keberangkatan
                    terhadap 3 (Tiga) orang kru stay on board Pesawat CI
                    2771 dengan rute penerbangan Denpasar-Taipei.
                </p>",
            'tanggal_nesia' => 'Senin, 31 Februari 2021'
        ]);
    }
}
