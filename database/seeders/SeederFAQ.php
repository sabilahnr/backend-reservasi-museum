<?php

namespace Database\Seeders;

use App\Models\faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederFAQ extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        faq::create([
            'id' => 1,
            'question' =>'Apakah didalam museum diperbolehkan makan atau minum?',
            'answer' =>'Selama didalam Museum tidak diperkenankan makan atau minum ya',
            'question_en' =>'Can i Bring food and beverage in museum ?',
            'answer_en' =>'NO, You can not'
        ]);
    }
}
