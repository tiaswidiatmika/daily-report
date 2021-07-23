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

        Template::create([
            'template_name' => 'cerita kanak-kanak',
            'case' => 'pada hari [hari] ku turut ayah ke [tempat]',
            'summary' => 'senang sekali [kegiatan] di [tempat]',
            'chronology' => 'pada hari [hari] ku turut ayah ke [tempat]',
            'measure' => 'pada hari [hari] ku turut ayah ke [tempat]',
            'conclusion' => 'pada hari [hari] ku turut ayah ke [tempat]',
        ]);
    }
}
