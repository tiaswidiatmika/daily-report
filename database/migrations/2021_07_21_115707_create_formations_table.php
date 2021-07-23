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
            $table->string('group')->nullable();
            $table->string('kasi')->nullable();
            $table->string('spv')->nullable();
            $table->string('opis')->nullable();
            $table->string('paspor_indonesia')->nullable();
            $table->string('diplomatik')->nullable();
            $table->string('foreigner')->nullable();
            $table->string('tata_usaha')->nullable();
            $table->string('protokoler')->nullable();
            $table->string('kru')->nullable();
            $table->string('honorer')->nullable();
            $table->string('other')->nullable();

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
