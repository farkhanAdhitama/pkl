<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Mail\SendEmail;

class TransaksiSiswa extends Model
{
    use HasFactory;
     protected $guarded = [];

    protected $fillable = [
        'id',
        'buku_id',
        'majalah_id',
        'cd_id',
        'anggota_id',
        'jenis',
        'status',
        'lama',
        'status_email',
        'denda',
        'petugas',

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
     public function getSelisih($lama){
        $diff = now()->diffInDays(Carbon::parse($this->attributes['created_at'])->addDays($lama), false);
        return $diff; 
        
    }
    
    public function lama_peminjaman(){
        $diff = now()->diffInDays(Carbon::parse($this->attributes['created_at']), false);
        return (-1*$diff)+1;
    }

    public function sendEmail($email_tujuan, $id, $nama, $berkas, $tenggat){

        TransaksiSiswa::where('id', $id)->update(['status_email' => 1]);
        $tujuan = $email_tujuan;
        $data_email = [
            'nama' => $nama,
            'berkas' => $berkas,
            'tenggat' => $tenggat,
        ];
        Mail::to($tujuan)->send(new SendEmail($data_email));
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
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
