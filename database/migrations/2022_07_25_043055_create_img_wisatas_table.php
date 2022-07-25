<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_wisatas', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->timestamps();
            $table->unsignedBigInteger('wisata_id');
 
            $table->foreign('wisata_id')->references('id')->on('wisatas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('img_wisatas');
    }
};
