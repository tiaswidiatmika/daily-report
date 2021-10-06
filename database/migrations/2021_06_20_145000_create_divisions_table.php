<?php

use App\Models\Division;
use App\Models\SubDivision;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        collect( Division::NAMES )->map(
            function( $division ) {
                // create division
                $newDivision = Division::create([
                    'name' => $division,
                ]);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisions');
    }
}
