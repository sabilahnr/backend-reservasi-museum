<?php

namespace Database\Seeders;

use App\Models\Pengunjung;
use Faker\Core\Number;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SebastianBergmann\Type\NullType;

class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengunjung::create([
            'id' => 1, 
            'nama' => 'Putri', 
            'museum' => 'Museum Radya Pustaka', 
            'kategori' => 'Dosen', 
            'phone' => '0877553721790' , 
            'kota' => 'Surakarta', 
            'negara' => NULL, 
            'jumlah' => '5', 
            'harga_awal' => '0', 
            'potongan_harga' => NULL, 
            'harga_akhir' => NULL, 
            'tanggal' => '28-11-2022', 
            'attachment' => NULL, 
            'pembayaran' => 'cash', 
            'id_admin' => '1', 
            'status' => '1', 

        ]);
        Pengunjung::create([
            'id' => 2, 
            'nama' => 'Abdul', 
            'museum' => 'Museum Radya Pustaka', 
            'kategori' => 'Seniman', 
            'phone' => '0864281936789', 
            'kota' => 'Yogyakarta', 
            'negara' => NULL, 
            'jumlah' => '8', 
            'harga_awal' => '0', 
            'potongan_harga' => NULL, 
            'harga_akhir' => NULL, 
            'tanggal' => '28-11-2022', 
            'attachment' =>NULL, 
            'pembayaran' => 'cash', 
            'id_admin' =>NULL, 
            'status' => NULL, 

        ]);
        Pengunjung::create([
            'id' => 3, 
            'nama' => 'Shinta',
            'museum' => 'Museum Radya Pustaka',
            'kategori' => 'Mahasiswa', 
            'phone' => '08721357890', 
            'kota' => 'Surakarta', 
            'negara' => NULL, 
            'jumlah' => '20', 
            'harga_awal' => '0' , 
            'potongan_harga' => NULL, 
            'harga_akhir' => NULL, 
            'tanggal' =>'27-11-2022', 
            'attachment' => NULL, 
            'pembayaran' => 'cash', 
            'id_admin' =>NULL, 
            'status' => NULL, 

        ]);
        Pengunjung::create([
            'id' => 4, 
            'nama' => 'Nur Cahya', 
            'museum' => 'Museum Keris Nusantara', 
            'kategori' => 'Umum', 
            'phone' => '087272781810', 
            'kota' => 'Tegal', 
            'negara' =>NULL, 
            'jumlah' =>'4', 
            'harga_awal' => '40000', 
            'potongan_harga' =>NULL, 
            'harga_akhir' => NULL, 
            'tanggal' =>'29-11-2022', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' =>5, 
            'nama' =>'Malikha', 
            'museum' =>'Museum Radya Pustaka', 
            'kategori' =>'Siswa', 
            'phone' =>'0877334427812', 
            'kota' =>'Surakarta', 
            'negara' =>NULL, 
            'jumlah' => '4', 
            'harga_awal' => '0', 
            'potongan_harga' =>NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>'27-11-2022', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' =>6, 
            'nama' =>'Ahmad', 
            'museum' =>'Museum Keris Nusantara', 
            'kategori' =>'Mahasiswa', 
            'phone' => '0870701001010', 
            'kota' =>'Yogyakarta', 
            'negara' =>NULL, 
            'jumlah' =>'12', 
            'harga_awal' => '60000', 
            'potongan_harga' =>NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>'28-11-2022', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' =>7, 
            'nama' =>'Islahnia Gadis', 
            'museum' =>'Museum Keris Nusantara', 
            'kategori' =>'Mahasiswa', 
            'phone' => '08724375404', 
            'kota' =>'Surakarta', 
            'negara' =>NULL, 
            'jumlah' =>'4', 
            'harga_awal' => '20000', 
            'potongan_harga' =>NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>'06-12-2022', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' =>8, 
            'nama' =>'Bima', 
            'museum' =>'Museum Keris Nusantara', 
            'kategori' =>'Rombongan Umum', 
            'phone' => '087575808010', 
            'kota' =>'Surakarta', 
            'negara' =>NULL, 
            'jumlah' =>'65', 
            'harga_awal' => '325000', 
            'potongan_harga' =>NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>"06-12-2022", 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' =>9, 
            'nama' =>'Adibah', 
            'museum' =>'Museum Keris Nusantara', 
            'kategori' =>'Umum', 
            'phone' => '081122334455', 
            'kota' =>'Semarang', 
            'negara' =>NULL, 
            'jumlah' =>'6', 
            'harga_awal' => '45000', 
            'potongan_harga' =>NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>'03-12-2022', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' =>10, 
            'nama' =>'Angga', 
            'museum' => 'Museum Keris Nusantara', 
            'kategori' => 'Rombongan Pelajar', 
            'phone' => '086060101010', 
            'kota' => 'Surakarta', 
            'negara' =>NULL, 
            'jumlah' =>'60', 
            'harga_awal' => '270000', 
            'potongan_harga' =>NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>'04-12-2022', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' =>11, 
            'nama' =>'Mala', 
            'museum' =>'Museum Radya Pustaka', 
            'kategori' => 'Seniman', 
            'phone' => '087755379233', 
            'kota' =>'Mojokerto', 
            'negara' =>NULL, 
            'jumlah' =>'5', 
            'harga_awal' => '0', 
            'potongan_harga' =>NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>'03-12-2022', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL ,
            'status' => NULL, 
            'created_at' =>'2022-11-15',   
            'updated_at' =>'2022-11-15',  

        ]);
        Pengunjung::create([
            'id' => 12, 
            'nama' =>'Steven', 
            'museum' => 'Museum Radya Pustaka', 
            'kategori' => 'Siswa', 
            'phone' => '087744679532', 
            'kota' =>'Surakarta', 
            'negara' =>NULL, 
            'jumlah' =>'5', 
            'harga_awal' => '0', 
            'potongan_harga' => NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>'01-07-2023', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' => 13, 
            'nama' => 'Soleh', 
            'museum' => 'Museum Keris Nusantara', 
            'kategori' => 'Mahasiswa', 
            'phone' => '087420853598', 
            'kota' => 'Yogyakarta', 
            'negara' =>NULL, 
            'jumlah' =>'4', 
            'harga_awal' => '20000', 
            'potongan_harga' =>NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>'06-01-2023', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' =>14, 
            'nama' => 'Hayati', 
            'museum' => 'Museum Radya Pustaka', 
            'kategori' =>'Siswa', 
            'phone' => '0877334271160', 
            'kota' =>'Malang', 
            'negara' =>NULL, 
            'jumlah' =>'8', 
            'harga_awal' =>'0', 
            'potongan_harga' =>NULL, 
            'harga_akhir' => NULL, 
            'tanggal' =>'04-01-2023', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' =>15, 
            'nama' =>'Lesty', 
            'museum' => 'Museum Keris Mahasiswa', 
            'kategori' => 'Mahasiswa',
            'phone' => '0872147012379', 
            'kota' => 'Jakarta', 
            'negara' =>NULL, 
            'jumlah' =>'2', 
            'harga_awal' => '10000', 
            'potongan_harga' =>NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>'04-01-2023', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        Pengunjung::create([
            'id' =>16, 
            'nama' => 'Billar', 
            'museum' => 'Museum Radya Pustaka', 
            'kategori' => 'Seniman', 
            'phone' => '0832148927190', 
            'kota' => 'Madiun', 
            'negara' =>NULL, 
            'jumlah' =>'2', 
            'harga_awal' => '0', 
            'potongan_harga' =>NULL, 
            'harga_akhir' =>NULL, 
            'tanggal' =>'05-01-2023', 
            'attachment' =>NULL, 
            'pembayaran' =>'cash', 
            'id_admin' =>NULL, 
            'status' =>NULL, 

        ]);
        
    }
}
