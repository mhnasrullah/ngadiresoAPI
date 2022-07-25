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
        Schema::create('faq_wis', function (Blueprint $table) {
            $table->id();
            $table->string('quest');
            $table->string('ans');
            $table->unsignedBigInteger('wisata_id');
            $table->timestamps();
 
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
        Schema::dropIfExists('faq_wis');
    }
};
