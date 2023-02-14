<?php

namespace Database\Seeders;

use App\Models\about;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        about::create([
            'id' => 1,
            'id_museum' => 1,
            'about' =>'<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Museum Keris Nusantara dan Radya Pustaka merupakan museum yang dikelola oleh pemerintah Solo. Keduanya memiliki daya tarik sendiri. Museum Keris Nusantara merupakan sebuah museum yang dibangun oleh Direktorat Jenderal Kebudayaan, Kementerian Pendidikan dan Kebudayaan melalui Direktorat Pelestarian Cagar Budaya dan Permuseuman sejak 2013 lalu. Diresmikan pada hari Selasa Wage, 15 Maulud Dal 1890, 9 Agustus 2017 atas prakarsa Walikota Solo yang Ke – 16 Bapak H. Ir. Joko Widodo. Museum Keris ini berdiri di atas kawasan Taman Budaya Sriwedari.&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Pada peresmian itu pula secara resmi Museum Keris berada di bawah UPT Museum Surakarta. Keris sebagai warisan budaya dunia mulai diakui oleh UNESCO pada tanggal 25 November 2005 di Paris, Perancis. Melalui pengakuan ini, keris mendapatkan pengakuan di mata dunia sebagai karya agung yang memiliki nilai filosofis tinggi, dan menunjukkan keunggulan budaya. Museum Radya Pustaka, Museum Tertua di Indonesia. Didirikan oleh Kanjeng Raden Adipati Sosrodiningrat IV pada 18 Oktober 1890 ini merupakan museum tertua yang ada di Indonesia. Museum Radya Pustaka berdiri di daerah Jalan Utama Kota Surakarta tepatnya adalah Jalan Slamet Riyadi, yang mana merupakan Museum pertama dan tertua di Indonesia.</p><h2>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Museum tersebut merupakan Museum kebanggaan masyarakat kota Surakarta yang mana memiliki keunikan tersendiri dibanding Museum- Museum Tua lainnya yakni dengan Koleksi benda Kunonya yang beragam dari mulai Arca Batu, Arca Perunggu, benda keperluan sehari hari dari Raja zaman dahulu, hadiah-hadiah dari Kaisar atau Raja dari bangsa lain dan Buku-Buku serat kuno karya .</h2>',
        ]);
        about::create([
            'id' => 2,
            'id_museum' => 2,
            'about' =>'<p>Panduan Tiket dapat di lihat melalui</p>',
        ]);
    }
}
