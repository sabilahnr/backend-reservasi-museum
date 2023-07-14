<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable =[
        'nama_kategori',
        'nama_kategori_en',
        'min',
        'max',
        'id_museum',
        'hari_biasa',
        'hari_libur',

    ];

    public function museum()
    {
        return $this->belongsTo(Museum::class, 'id_museum');
    }

    // public function kategori(){
    //     return $this->hasMany(kategori::class);
    // }
}
