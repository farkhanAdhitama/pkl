<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use illuminate\Support\Carbon;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at'];

    public function getCreatedAttribute(){
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d M Y');
    }

    public function getUpdatedAttribute(){
        return Carbon::parse($this->attributes['updated_at'])
            ->translatedFormat('l, d M Y');
    }

    public function jenis()
    {
        return $this->belongsTo(Jenisbuku::class);
    }

    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }

    public function transaksi_guru(){
        return $this->hasMany(TransaksiGuru::class);
    }


    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }

    public function tempat_terbit()
    {
        return $this->belongsTo(TempatTerbit::class);
    }
}
