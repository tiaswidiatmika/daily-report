<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $date = ucfirst(Carbon::parse(Carbon::now()->locale('id'))->format('D, d F Y'));
        // protected $fillable = ['user_id','title', 'case', 'summary', 'chronology', 'measure', 'conclusion'];
        Post::create([
            'report_id' => \App\Models\Report::today()->id,
            'section' => 'arrival',
            'user_id' => 1,
            'date' => todayIs()->date,
            'time' => todayIs()->time . ' - ' . now('Asia/Shanghai')->locale('id')->addHour(2)->format('h:i') . ' WITA',
            'case' => "Telah dilakukan Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei",
            'summary' => "Bahwa, pada hari, tanggal tersebut di atas dilakukan Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei",
            'chronology' => "Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei dilakukan pada pukul 13.40 WITA",
            'measure' => "Melaporkan kejadian tersebut pada pimpinan. Bahwa telah dilakukan Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei.",
            'conclusion' => "Bahwa telah dilakukan Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei.",
            'qrcode' => 'seederqrcode.png',
        ]);

    }
}
