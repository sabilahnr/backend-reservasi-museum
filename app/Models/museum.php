<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class museum extends Model
{
    use HasFactory;
    protected $table = 'museum';
    protected $fillable =[
        'nama',

    ];
}
