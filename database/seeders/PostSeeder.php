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
        // $date = ucfirst(Carbon::parse(Carbon::now()->locale('id'))->format('D, d F Y'));
        $today = Carbon::now('Asia/Shanghai')->locale('id');
        $today->settings(['formatFunction' => 'translatedFormat']);
        $date = $today->format('l, j F Y');
        $hour = $today->format('h:i');
        // protected $fillable = ['user_id','title', 'case', 'summary', 'chronology', 'measure', 'conclusion'];
        Post::create([
            'section' => 'arrival',
            'user_id' => 1,
            'date' => $date,
            'time' => $hour . ' - ' . $today->addHour(2)->format('h:i') . ' WITA',
            'case' => "Telah dilakukan Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei",
            'summary' => "Bahwa, pada hari, tanggal tersebut di atas dilakukan Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei",
            'chronology' => "Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei dilakukan pada pukul 13.40 WITA",
            'measure' => "Melaporkan kejadian tersebut pada pimpinan. Bahwa telah dilakukan Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei.",
            'conclusion' => "Bahwa telah dilakukan Pengawasan Keberangkatan terhadap 3 (Tiga) orang kru stay on board Pesawat CI 2771 dengan rute penerbangan Denpasar-Taipei.",
        ]);
    }
}
