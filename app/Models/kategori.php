<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable =[
        'id_museum',
        'nama_kategori',
        'min',
        'max',

    ];

    public function museum(){
        return $this->belongsTo('id_museum');
    }

    public function harga(){
        return $this->hasMany('id_kategori');
    }
}
