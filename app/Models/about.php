<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about extends Model
{
    use HasFactory;
    protected $table = 'about';
    protected $fillable =[
        'id_museum',
        'about',
    ];

    // protected $with = ['museum'];

    public function museum()
    {
        return $this->belongsTo(museum::class, 'id', 'id');
    }
}
