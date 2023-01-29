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
            $table->string('peruntukan')->nullable();
            $table->string('jenis_id')->nullable();
            $table->string('judul_buku');
            $table->string('judul_asli')->nullable();
            $table->string('penulis');
            $table->integer('jumlah')->nullable();
            $table->string('subyek')->nullable();
            $table->string('penerjemah')->nullable();
            $table->enum('kategori',['Fiksi','Nonfiksi', 'Referensi']);
            $table->enum('bahasa',['Indonesia','Arab','Inggris','Lainnya']);
            $table->enum('perolehan',['Pembelian','Hadiah','Hibah','Droping']);
            $table->string('penerbit_id')->nullable();
            $table->string('tempat_terbit')->nullable();
            $table->string('jilid')->nullable();
            $table->integer('cetakan')->nullable();
            $table->integer('halaman')->nullable();
            $table->integer('lebar')->nullable();
            $table->integer('panjang')->nullable();
            $table->integer('edisi')->nullable();
            $table->string('rak')->nullable();
            $table->string('isbn');
            $table->integer('harga')->nullable();
            $table->string('tahun_terbit');
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
