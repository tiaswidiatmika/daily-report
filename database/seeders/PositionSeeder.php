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
        $positionPresent = ['foreigner', 'paspor_indonesia', 'diplomatik', 'protokoler'];
        $positionAbsent = ['cuti', 'izin', 'sakit'];
        foreach ($positionPresent as $position) {
            Position::create([
                'name' => $position,
                'countAbsent' => false
            ]);
        }

        foreach ($positionAbsent as $position) {
            Position::create([
                'name' => $position,
                'countAbsent' => true
            ]);
        }
        
    }
}
