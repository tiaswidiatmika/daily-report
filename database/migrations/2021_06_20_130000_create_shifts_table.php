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
            $table->timestamps();
        });

        $shifts = [
            'Pagi Pertama',
            'Pagi Kedua',
            'Siang Pertama',
            'Siang Kedua',
            'Malam Pertama',
            'Malam Kedua',
        ];

        foreach ($shifts as $shift) {
            Shift::create([ 'name' => $shift ]);
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
