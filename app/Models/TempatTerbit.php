<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TempatTerbit extends Model
{
    use HasFactory;

    protected $fillable = [
        'kota',
    ];

    public function tempat_ke_buku(){
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
