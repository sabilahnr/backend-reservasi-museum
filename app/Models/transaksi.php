<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    protected $fillable = [
        'nama',
        'id_kategori',
        'kota',
        'jumlah',
        'total_harga',
        'tanggal',
        'email',
        'pembayaran',
        'kode_tiket',
        'id_admin',
        'kehadiran',
        'tanggal_pembayaran',
        'tanggal_kehadiran',
        'status',
        'invoice',
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
    
    
}
