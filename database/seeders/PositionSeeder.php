<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positionPresent = ['foreigner', 'paspor_indonesia', 'diplomatik', 'protokoler', 'spv', 'asisten_spv', 'honorer'];
        $positionAbsent = ['cuti', 'izin', 'sakit'];
        foreach ($positionPresent as $position) {
            Position::create([
                'name' => $position,
                'count_absent' => false
            ]);
        }

        foreach ($positionAbsent as $position) {
            Position::create([
                'name' => $position,
                'count_absent' => true
            ]);
        }
        
    }
}
