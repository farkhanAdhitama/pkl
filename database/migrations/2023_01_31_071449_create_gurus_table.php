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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->enum('jabatan',['Guru','Karyawan']);
            $table->string('nama');
            $table->string('nik');
            $table->string('email');
            $table->date('masa_berlaku');
            $table->enum('status',['Aktif','NonAktif'])->default('Aktif');
            $table->string('foto_guru')->nullable();
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
        Schema::dropIfExists('gurus');
    }
};
