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
        Schema::create('majalahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal_terbit');
            $table->integer('nomor');
            $table->integer('volume');
            $table->string('tahun');
            $table->string('issn');
            $table->string('topik')->nullable();
            $table->string('jumlah')->nullable();
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
        Schema::dropIfExists('majalahs');
    }
};
