<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faq extends Model
{
    use HasFactory;
    protected $table = 'faq';
    protected $fillable =[
        'answer',
        'answer_en',
        'question',
        'question_en',
    ];
}
