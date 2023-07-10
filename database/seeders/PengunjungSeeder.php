<?php

namespace Database\Seeders;

use App\Models\Pengunjung;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */public function run()
    {
    $pengunjungData = [
            [
            'id' => 1,
            'nama' => 'Putri',
            'museum' => 'Museum Radya Pustaka',
            'kategori' => 'Dosen',
            'phone' => '0877553721790',
            'kota' => 'Surakarta',
            'jumlah' => '5',
            'harga_awal' => '0',
            'status' => 'Lunas',
            'tanggal' => '28-11-2022',
            'tanggal_pembayaran' => '28-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => '1',
            'kode_tiket' => 'MRP-28-11-2022-1'
            ],[
            'id' => 2,
            'nama' => 'Abdul',
            'museum' => 'Museum Radya Pustaka',
            'kategori' => 'Seniman',
            'phone' => '0864281936789',
            'kota' => 'Yogyakarta',
            'jumlah' => '8',
            'harga_awal' => '0',
            'status' => 'Lunas',
            'tanggal' => '28-11-2022',
            'tanggal_pembayaran' => '28-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP-28-11-2022-2'
            ],[
            'id' => 3,
            'nama' => 'Shinta',
            'museum' => 'Museum Radya Pustaka',
            'kategori' => 'Mahasiswa',
            'phone' => '08721357890',
            'kota' => 'Surakarta',
            'jumlah' => '20',
            'harga_awal' => '0',
            'status' => 'Lunas',
            'tanggal' => '27-11-2022',
            'tanggal_pembayaran' => '27-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP-27-11-2022-3'
        ],[

            'id' => 4,
            'nama' => 'Nur Cahya',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Umum',
            'phone' => '087272781810',
            'kota' => 'Tegal',
            'jumlah' => '4',
            'harga_awal' => '40000',
            'status' => 'Lunas',
            'tanggal' => '29-11-2022',
            'tanggal_pembayaran' => '29-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => 'Samuel',
            'kode_tiket' => 'MKN-29-11-2022-4'
        ],[
            'id' => 5,
            'nama' => 'Malikha',
            'museum' => 'Museum Radya Pustaka',
            'kategori' => 'Siswa',
            'phone' => '0877334427812',
            'kota' => 'Surakarta',
            'jumlah' => '4',
            'harga_awal' => '0',
            'status' => 'Lunas',
            'tanggal' => '27-11-2022',
            'tanggal_pembayaran' => '27-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP-27-11-2022-5'
        ],[
            'id' => 6,
            'nama' => 'Ahmad',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Mahasiswa',
            'phone' => '0870701001010',
            'kota' => 'Yogyakarta',
            'jumlah' => '12',
            'harga_awal' => '60000',
            'status' => 'Lunas',
            'tanggal' => '28-11-2022',
            'tanggal_pembayaran' => '28-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'kehadiran' => "Hadir",
            'pembayaran' => 'tunai',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN-28-11-2022-6'
        ],[
            'id' => 7,
            'nama' => 'Islahnia Gadis',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Mahasiswa',
            'phone' => '08724375404',
            'kota' => 'Surakarta',
            'jumlah' => '4',
            'harga_awal' => '20000',
            'status' => 'Lunas',
            'tanggal' => '06-12-2022',
            'tanggal_pembayaran' => '06-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN-06-12-2022-7'
        ],[
            'id' => 8,
            'nama' => 'Bima',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Rombongan Umum',
            'phone' => '087575808010',
            'kota' => 'Surakarta',
            'jumlah' => '65',
            'harga_awal' => '325000',
            'kehadiran' => "Hadir",
            'tanggal' => '06-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN-06-12-2022-8'
        ],[
            'id' => 9,
            'nama' => 'Adibah',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Umum',
            'phone' => '081122334455',
            'kota' => 'Semarang',
            'jumlah' => '6',
            'harga_awal' => '45000',
            'tanggal' => '03-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN-03-12-2022-9'
        ],[
            'id' => 10,
            'nama' => 'Angga',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Rombongan Pelajar',
            'phone' => '086060101010',
            'kota' => 'Surakarta',
            'jumlah' => '60',
            'harga_awal' => '270000',
            'tanggal' => '04-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => "Udin",
            'id_admin' => null,
            'kode_tiket' => 'MKN-04-12-2022-10'
        ],[
            'id' => 11,
            'nama' => 'Mala',
            'museum' => 'Museum Radya Pustaka',
            'kategori' => 'Seniman',
            'phone' => '087755379233',
            'kota' => 'Mojokerto',
            'jumlah' => '5',
            'harga_awal' => '0',
            'status' => 'Lunas',
            'tanggal' => '03-12-2022',
            'tanggal_pembayaran' => '03-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP-03-12-2022-11'
        ],[
            'id' => 12,
            'nama' => 'Steven',
            'museum' => 'Museum Radya Pustaka',
            'kategori' => 'Siswa',
            'phone' => '087744679532',
            'kota' => 'Surakarta',
            'jumlah' => '5',
            'harga_awal' => '0',
            'status' => 'Lunas',
            'tanggal' => '01-07-2023',
            'tanggal_pembayaran' => '01-07-2023',
            'kehadiran' => "Hadir",
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP-01-07-2023-12'
        ],[
            'id' => 13,
            'nama' => 'Soleh',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Mahasiswa',
            'phone' => '087420853598',
            'kota' => 'Yogyakarta',
            'jumlah' => '4',
            'harga_awal' => '20000',
            'tanggal' => '06-01-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => "Udin",
            'id_admin' => null,
            'kode_tiket' => 'MKN-06-01-2023-13'
        ],[
            'id' => 14,
            'nama' => 'Hayati',
            'museum' => 'Museum Radya Pustaka',
            'kategori' => 'Siswa',
            'phone' => '0877334271160',
            'kota' => 'Malang',
            'jumlah' => '8',
            'harga_awal' => '0',
            'kehadiran' => "Hadir",
            'status' => 'Lunas',
            'tanggal' => '04-01-2023',
            'tanggal_pembayaran' => '04-01-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP-04-01-2023-14'
        ],[
            'id' => 15,
            'nama' => 'Lesty',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Mahasiswa',
            'phone' => '0872147012379',
            'kota' => 'Jakarta',
            'jumlah' => '2',
            'status' => 'Lunas',
            'harga_awal' => '10000',
            'tanggal' => '04-01-2023',
            'kehadiran' => "Hadir",
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKM-04-01-2023-15'
        ]
        ,[
            'id' => 16,
            'nama' => 'Billar',
            'museum' => 'Museum Radya Pustaka',
            'kategori' => 'Seniman',
            'phone' => '0832148927190',
            'kota' => 'Madiun',
            'jumlah' => '2',
            'harga_awal' => '0',
            'status' => 'Lunas',
            'tanggal' => '05-01-2023',
            'tanggal_pembayaran' => '05-01-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP-05-01-2023-16'
        ]
        ,[
            'id' => 17,
            'nama' => 'Wanwan',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Dosen',
            'phone' => '0872147012379',
            'kota' => 'Papua',
            'jumlah' => '5',
            'harga_awal' => '25000',
            'tanggal' => '04-04-2023',
            'tanggal_pembayaran' => '04-04-2023',
            'email' => 'samuelstev0902@gmail.com',
            'kehadiran' => "Hadir",
            'pembayaran' => 'tunai',
            'status' => 'Lunas',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKM-04-04-2023-15'
        ]
        ,[
            'id' => 18,
            'nama' => 'Roger',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Mahasiswa',
            'phone' => '0872147012379',
            'kota' => 'Jakarta',
            'jumlah' => '2',
            'harga_awal' => '10000',
            'tanggal' => '04-02-2023',
            'tanggal_pembayaran' => '04-02-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'status' => 'Lunas',
            'kehadiran' => "Hadir",
            'id_admin' => "Udin",
            'kode_tiket' => 'MKM-04-02-2023-15'
        ]
        ,[
            'id' => 19,
            'nama' => 'Samsul',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Mahasiswa',
            'phone' => '0872147012379',
            'kota' => 'Jakarta',
            'jumlah' => '2',
            'harga_awal' => '10000',
            'tanggal' => '04-03-2023',
            'tanggal_pembayaran' => '04-03-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'kehadiran' => "Hadir",
            'status' => 'Lunas',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKM-04-03-2023-15'
        ]
        ,[
            'id' => 20,
            'nama' => 'Budiman',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Mahasiswa',
            'phone' => '0872147012379',
            'kota' => 'Jakarta',
            'jumlah' => '2',
            'harga_awal' => '10000',
            'tanggal' => '04-03-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MKM-04-03-2023-15'
        ]
    ];

    foreach ($pengunjungData as $data) {
        $tanggal = Carbon::createFromFormat('d-m-Y', $data['tanggal']);
        $data['updated_at'] = $tanggal;
        $data['created_at'] = $tanggal;

        Pengunjung::create($data);
    }
        
    }
}