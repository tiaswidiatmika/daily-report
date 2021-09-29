<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shifts = [
            'pagi_pertama' => '05.00 — 14.00 WITA',
            'pagi_kedua' => '05.00 — 14.00 WITA',
            'siang_pertama' => '13.00 — 22.00 WITA',
            'siang_kedua' => '13.00 — 22.00 WITA',
            'malam_pertama' => '21.00 — 06.00 WITA',
            'malam_kedua' => '21.00 — 06.00 WITA',
            'off_pertama' => '-',
            'off_kedua' => '-',
        ];
        foreach ($shifts as $shiftName => $shiftRange) {
            DB::table('shift_schedules')->insert([
                'name' => $shiftName,
                'range' => $shiftRange,
            ]);
        }
    }
}
