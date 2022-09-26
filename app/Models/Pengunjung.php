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
        'negara',
        'phone',
        'jumlah',
        'museum',
        'kategori',
        'jadwal',
        'foto_ktp',
        'foto_kia',
        'foto_ktm',
        'foto_paspor',
        'file',
    ];
}
