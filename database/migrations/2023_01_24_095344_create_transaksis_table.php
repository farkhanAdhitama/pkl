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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('buku_id')->nullable();
            $table->string('anggota_id')->nullable();
            $table->enum('status',['Dipinjam','Dikembalikan'])->default('Dipinjam');
            $table->integer('lama');
            $table->integer('denda')->nullable();
            $table->timestamp('tgl_kembali');
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
        Schema::dropIfExists('transaksis');
    }
};
