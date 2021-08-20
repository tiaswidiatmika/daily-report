<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('group')->nullable();
            $table->json('kaunit')->nullable();
            $table->json('spv')->nullable();
            $table->json('opis')->nullable();
            $table->json('paspor_indonesia')->nullable();
            $table->json('diplomatik')->nullable();
            $table->json('foreigner')->nullable();
            $table->json('cuti')->nullable();
            $table->json('izin')->nullable();
            $table->json('sakit')->nullable();
            $table->json('tata_usaha')->nullable();
            $table->json('protokoler')->nullable();
            $table->json('kru')->nullable();
            $table->json('honorer')->nullable();
            $table->json('other')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formations');
    }
}
