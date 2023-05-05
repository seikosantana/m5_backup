<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_siswa',
        'tanggal',
        'periode_lunas'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'periode_lunas' => "integer"
    ];
}
