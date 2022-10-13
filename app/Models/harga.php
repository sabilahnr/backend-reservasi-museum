<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class harga extends Model
{
    use HasFactory;
    protected $table = 'harga';
    protected $fillable =[
        'id_kategori',
        'hari_biasa',
        'hari_libur',
        

    ];
    protected $guarded = [];

    

   

}
