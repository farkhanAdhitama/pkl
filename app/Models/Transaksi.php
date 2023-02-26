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
            ->translatedFormat('l, d M Y');
    }

    public function getTenggatWaktu($lama){
        return Carbon::parse($this->attributes['created_at'])->addDays($lama)
            ->translatedFormat('l, d M Y');
    }

    public function getTanggalKembali(){
        return Carbon::parse($this->attributes['updated_at'])
            ->translatedFormat('l, d M Y');
    }

    public function getDenda($lama){
        $diff = now()->diffInDays(Carbon::parse($this->attributes['created_at'])->addDays($lama), false);
        $denda = 0;
        if ($diff < 0){
            $denda = $denda + (-(500)*($diff)); 
        }
        
        return $denda;
    }

    public function lama_peminjaman(){
        $diff = now()->diffInDays(Carbon::parse($this->attributes['created_at']), false);
        return (-1*$diff)+1;
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
