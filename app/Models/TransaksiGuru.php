<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Majalah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiGuru extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'id',
        'buku_id',
        'majalah_id',
        'cd_id',
        'guru_id',
        'jenis',
        'status',
        'lama',
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

    public function lama_peminjaman(){
        $diff = now()->diffInDays(Carbon::parse($this->attributes['created_at']), false);
        return (-1*$diff)+1;
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);    
    }

    public function majalah()
    {
        return $this->belongsTo(Majalah::class);
    }
    public function cd()
    {
        return $this->belongsTo(CD::class);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}