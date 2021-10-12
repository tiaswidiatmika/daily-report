<?php

use App\Models\Shift;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('range');
            $table->timestamps();
        });

        $shifts = [
            'Pagi Pertama' => '05.00 - 14.00 WITA',
            'Pagi Kedua' => '05.00 - 14.00 WITA',
            'Siang Pertama' => '13.00 - 22.00 WITA',
            'Siang Kedua' => '13.00 - 22.00 WITA',
            'Malam Pertama' => '21.00 - 06.00 WITA',
            'Malam Kedua' => '21.00 - 06.00 WITA',
        ];

        foreach ($shifts as $shift => $range) {
            Shift::create([ 'name' => $shift, 'range' => $range ]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
