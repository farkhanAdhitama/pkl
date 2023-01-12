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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku');
            $table->string('isbn');
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('tahun_terbit');
            $table->enum('kategori',['fiksi','nonfiksi']);
            $table->string('jenis_id')->nullable();
            $table->integer('jumlah');
            $table->date('dicatat_pada')->nullable();
            $table->string('sampul')->nullable();
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
        Schema::dropIfExists('bukus');
    }
};
