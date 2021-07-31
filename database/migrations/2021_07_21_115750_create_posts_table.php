<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('section');
            $table->text('date'); // to hold hari, zona waktu. eg. "Senin, 2 Januari 2020" in string
            $table->text('time'); // to hold jam & zona waktu. eg. "12:69 - 69:12 Waktu timor timur selatan" in string
            $table->text('case');
            $table->text('summary');
            $table->text('chronology');
            $table->text('measure');
            $table->text('conclusion');
            $table->string('qrcode')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
