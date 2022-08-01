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
        Schema::create('edits', function (Blueprint $table) {
            $table->id();
            $table->string('jumbotron');
            $table->string('tentangDesa');
            $table->string('imgTentangDesa');
            $table->string('imgKades');
            $table->string('sambutanKades');
            $table->string('namaKades');
            $table->integer('jmlPria');
            $table->integer('jmlWanita');
            $table->integer('jmlPenduduk');
            $table->string('jmbtSejarah');
            $table->string('jmbtKabar');
            $table->string('jmbtFaq');
            $table->string('jmbtWisata');
            $table->string('jmbtSurat');
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
        Schema::dropIfExists('edits');
    }
};
