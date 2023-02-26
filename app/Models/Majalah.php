<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Majalah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_terbit',
        'nomor',
        'volume',
        'tahun',
        'issn',
        'topik',
        'jumlah',
    ];


    public function getCreatedAttribute(){
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d M Y');
    }

    public function getUpdatedAttribute(){
        return Carbon::parse($this->attributes['updated_at'])
            ->translatedFormat('l, d M Y');
    }

    public function getTanggalTerbit(){
        return Carbon::parse($this->attributes['tanggal_terbit'])
            ->translatedFormat('d/m/Y');
    }

     public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }

    public function transaksi_guru(){
        return $this->hasMany(TransaksiGuru::class, 'id');
    }
}
