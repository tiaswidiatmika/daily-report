<?php

use App\Models\Division;
use App\Models\SubDivision;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_divisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id');
            $table->string('name');
            $table->timestamps();
        });

        Division::all()->map( function( $division ) {
            collect(Division::SUB_UNIT)->map( function( $subDivision ) use( $division ) {
                SubDivision::create([
                    'division_id' => $division->id,
                    'name' => $subDivision
                ]);
            } );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_divisions');
    }
}
