<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tikets extends Model
{
    use HasFactory;
    protected $table = 'tikets';
    protected $fillable = [
        'kode_tiket',
        'tanggal',
        'museum',
        'kategori',
        'status',
        'jumlah',
    ];
}
