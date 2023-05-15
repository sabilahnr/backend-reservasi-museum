<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarMuseum extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_museum",
        "nama_gambar"
    ];

}
