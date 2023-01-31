<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Penerbit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_penerbit',
        'alamat',
        'kota',
    ];

    public function penerbit_ke_buku(){
        return $this->hasMany(Buku::class);
    }

    public function getCreatedAttribute(){
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('l, d M Y');
    }

    public function getUpdatedAttribute(){
        return Carbon::parse($this->attributes['updated_at'])
            ->translatedFormat('l, d M Y');
    }

}
