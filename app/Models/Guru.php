<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'jabatan',
        'nama',
        'email',
        'nik',
        'masa_berlaku',
        'status',
        'foto_guru',

    ];


    public function getCreatedAttribute(){
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d M Y');
    }

    public function getMasaBerlaku(){
        return Carbon::parse($this->attributes['masa_berlaku'])
            ->translatedFormat('l, d M Y');
    }

    public function getUpdatedAttribute(){
        return Carbon::parse($this->attributes['updated_at'])
            ->translatedFormat('l, d M Y');
    }

     public function transaksi(){
        return $this->hasMany(TransaksiGuru::class);
    }

}
