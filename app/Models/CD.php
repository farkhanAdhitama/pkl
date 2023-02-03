<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Carbon;

class CD extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_kelompok',
        'judul_cd',
        'perolehan',
        'jumlah',
    ];
    protected $dates = ['created_at'];

    public function getCreatedAttribute(){
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d M Y');
    }

    public function getUpdatedAttribute(){
        return Carbon::parse($this->attributes['updated_at'])
            ->translatedFormat('l, d M Y');
    }

    public function buku(){
        return $this->hasMany(Buku::class);
    }
}