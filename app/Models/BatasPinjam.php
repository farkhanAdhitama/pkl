<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatasPinjam extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'batas_siswa',
        'batas_guru',
    ];
}
