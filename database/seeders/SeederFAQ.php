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
            'answer' =>'Apakah didalam museum diperbolehkan makan atau minum?',
            'question' =>'Selama didalam Museum tidak diperkenankan makan atau minum ya'
        ]);
    }
}
