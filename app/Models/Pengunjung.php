<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;
    protected $table = 'pengunjung';
    protected $fillable = [
        'nama',
        'kota',
        'phone',
        'jumlah',
        'museum',
        'kategori',
        'tanggal',
        'foto',
        'harga',
        'pembayaran',
        'status',
    ];
}
