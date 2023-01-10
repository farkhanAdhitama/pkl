<?php

namespace Database\Seeders;
Use \Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\DBAL\TimestampType;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bukus')->insert([
            'kode_buku' => 'AB-233',
            'judul_buku' => 'Matahari',
            'penulis' => 'Tere Liye',
            'penerbit' => 'Penerbit Ahli',
            'tahun_terbit'=> '2012',
            'kategori' => 'Fiksi'
        ]);
    }
}
