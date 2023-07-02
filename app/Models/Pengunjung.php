<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Museum;


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

    public function museum()
{
    return $this->belongsTo(Museum::class, 'museum', 'nama_museum');
}

}
