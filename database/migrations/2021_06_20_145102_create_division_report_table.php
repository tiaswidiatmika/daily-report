<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('division_report', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('division_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('report_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('division_report');
    }
}
