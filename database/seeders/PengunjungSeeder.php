<?php

namespace Database\Seeders;

use App\Models\Pengunjung;
use Illuminate\Database\Seeder;

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
            'phone' => '0877553721790',
            'kota' => 'Surakarta',
            'jumlah' => '5',
            'harga_awal' => '0',
            'status' => 'Lunas',
            'tanggal' => '28-11-2022',
            'tanggal_pembayaran' => '28-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'cash',
            'id_admin' => '1',
            'kode_tiket' => 'MRP-28-11-2022-1'
        ]);

        Pengunjung::create([
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
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MRP-28-11-2022-2'
        ]);

        Pengunjung::create([
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
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MRP-27-11-2022-3'
        ]);

        // Add kode_tiket for each remaining seeder data

        Pengunjung::create([
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
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'cash',
            'id_admin' => 'Samuel',
            'kode_tiket' => 'MKN-29-11-2022-4'
        ]);

        Pengunjung::create([
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
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MRP-27-11-2022-5'
        ]);

        Pengunjung::create([
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
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'cash',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN-28-11-2022-6'
        ]);

        Pengunjung::create([
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
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'cash',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN-06-12-2022-7'
        ]);

        Pengunjung::create([
            'id' => 8,
            'nama' => 'Bima',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Rombongan Umum',
            'phone' => '087575808010',
            'kota' => 'Surakarta',
            'jumlah' => '65',
            'harga_awal' => '325000',
            'tanggal' => '06-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MKN-06-12-2022-8'
        ]);

        Pengunjung::create([
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
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MKN-03-12-2022-9'
        ]);

        Pengunjung::create([
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
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MKN-04-12-2022-10'
        ]);

        Pengunjung::create([
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
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MRP-03-12-2022-11'
        ]);

        Pengunjung::create([
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
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MRP-01-07-2023-12'
        ]);

        Pengunjung::create([
            'id' => 13,
            'nama' => 'Soleh',
            'museum' => 'Museum Keris Nusantara',
            'kategori' => 'Mahasiswa',
            'phone' => '087420853598',
            'kota' => 'Yogyakarta',
            'jumlah' => '4',
            'harga_awal' => '20000',
            'tanggal' => '06-01-2023',
            'tanggal_pembayaran' => '06-01-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MKN-06-01-2023-13'
        ]);

        Pengunjung::create([
            'id' => 14,
            'nama' => 'Hayati',
            'museum' => 'Museum Radya Pustaka',
            'kategori' => 'Siswa',
            'phone' => '0877334271160',
            'kota' => 'Malang',
            'jumlah' => '8',
            'harga_awal' => '0',
            'status' => 'Lunas',
            'tanggal' => '04-01-2023',
            'tanggal_pembayaran' => '04-01-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MRP-04-01-2023-14'
        ]);

        Pengunjung::create([
            'id' => 15,
            'nama' => 'Lesty',
            'museum' => 'Museum Keris Mahasiswa',
            'kategori' => 'Mahasiswa',
            'phone' => '0872147012379',
            'kota' => 'Jakarta',
            'jumlah' => '2',
            'harga_awal' => '10000',
            'tanggal' => '04-01-2023',
            'tanggal_pembayaran' => '04-01-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MKM-04-01-2023-15'
        ]);

        Pengunjung::create([
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
            'pembayaran' => 'cash',
            'id_admin' => null,
            'kode_tiket' => 'MRP-05-01-2023-16'
        ]);
    }
}