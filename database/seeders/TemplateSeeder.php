<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // protected $fillable = ['template_name', 'case', 'summary', 'chronology', 'measure', 'conclusion'];

        $example = [
            'nihil' => [
                'template_name' => 'Laporan Nihil',
                'case' => '<i>NIHIL</i>',
                'summary' => '<i>NIHIL</i>',
                'chronology' =>'<i>NIHIL</i>',
                'measure' =>'<i>NIHIL</i>',
                'conclusion' =>'<i>NIHIL</i>',
            ],
            'charter kru turun' => [
                'template_name' => 'Pemeriksaan Pesawat Charter (Kru Turun)',
                'case' => 'Pemeriksaan [bagian kedatangan / keberangkatan] terhadap [jumlah awak] awak alat angkut pesawat charter [nama pesawat] ([kode penerbangan]) rute penerbangan [rute penerbangan].',
                'summary' => 'Bahwa, pada hari, tanggal tersebut di atas, telah dilakukan pemeriksaan [bagian kedatangan / keberangkatan] terhadap [jumlah awak] orang kru pesawat charter [nama pesawat] ([kode penerbangan]), rute [rute penerbangan] pada pukul [waktu mendarat] WITA di Terminal Selatan Bandar Udara Internasional Ngurah Rai Denpasar, dengan rincian terlampir.',
                'chronology' => 'Pesawat tiba pada pukul [waktu mendarat] WITA di Terminal Selatan Bandara I Gusti Ngurah Rai. Pemeriksaan imigrasi juga dilakukan di terminal selatan oleh Petugas Imigrasi',
                'measure' => '1. Melaporkan kejadian tersebut kepada pimpinan.<br>2. Melakukan pemeriksaan terhadap [jumlah awak] orang kru',
                'conclusion' => 'Bahwa telah dilakukan pemeriksaan keimigrasian terhadap [jumlah awak] orang kru pesawat charter [nama pesawat] ([kode penerbangan])',
            ]
        ];

        foreach ($example as $key => $value) Template::create($value);
    }
}
