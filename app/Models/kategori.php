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

    ];

    public function museum(){
        return $this->belongsTo(museum::class,'id_museum');
    }
}
