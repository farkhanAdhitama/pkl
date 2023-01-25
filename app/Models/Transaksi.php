<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'id',
        'buku_id',
        'anggota_id',
        'lama',
        'denda',
    ];

    public function getCreatedAttribute(){
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d M Y, H:i');
    }

    public function getTenggatWaktu($lama){
        return Carbon::parse($this->attributes['created_at'])->addDays($lama)
            ->translatedFormat('l, d M Y');
    }

    public function getTanggalKembali(){
        return Carbon::parse($this->attributes['updated_at'])
            ->translatedFormat('l, d M Y, H:i');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

}
