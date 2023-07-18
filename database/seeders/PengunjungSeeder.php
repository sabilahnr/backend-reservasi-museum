<?php

namespace Database\Seeders;

use App\Models\Pengunjung;
use App\Models\transaksi;
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
            'id_kategori' => 11,
            'phone' => '0877553721790',
            'kota' => 'Surakarta',
            'jumlah' => '5',
            'total_harga' => '0',
            'status' => 'Lunas',
            'tanggal' => '28-11-2022',
            'tanggal_pembayaran' => '28-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => '1',
            'kode_tiket' => 'MRP21'
            ],[
            'id' => 2,
            'nama' => 'Abdul',
            'id_kategori' => 14,
            'phone' => '0864281936789',
            'kota' => 'Yogyakarta',
            'jumlah' => '8',
            'total_harga' => '0',
            'status' => 'Lunas',
            'tanggal' => '28-11-2022',
            'tanggal_pembayaran' => '28-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP22'
            ],[
            'id' => 3,
            'nama' => 'Shinta',
            'id_kategori' => 3,
            'phone' => '08721357890',
            'kota' => 'Surakarta',
            'jumlah' => '20',
            'total_harga' => '0',
            'status' => 'Lunas',
            'tanggal' => '27-11-2022',
            'tanggal_pembayaran' => '27-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP23'
        ],[

            'id' => 4,
            'nama' => 'Nur Cahya',
            'id_kategori' => 1,
            'phone' => '087272781810',
            'kota' => 'Tegal',
            'jumlah' => '4',
            'total_harga' => '40000',
            'status' => 'Lunas',
            'tanggal' => '29-11-2022',
            'tanggal_pembayaran' => '29-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => 'Samuel',
            'kode_tiket' => 'MKN14'
        ],[
            'id' => 5,
            'nama' => 'Malikha',
            'id_kategori' => 7,
            'phone' => '0877334427812',
            'kota' => 'Surakarta',
            'jumlah' => '4',
            'total_harga' => '0',
            'status' => 'Lunas',
            'tanggal' => '27-11-2022',
            'tanggal_pembayaran' => '27-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP25'
        ],[
            'id' => 6,
            'nama' => 'Ahmad',
            'id_kategori' => 3,
            'phone' => '0870701001010',
            'kota' => 'Yogyakarta',
            'jumlah' => '12',
            'total_harga' => '60000',
            'status' => 'Lunas',
            'tanggal' => '28-11-2022',
            'tanggal_pembayaran' => '28-11-2022',
            'email' => 'samuelstev0902@gmail.com',
            'kehadiran' => "Hadir",
            'pembayaran' => 'tunai',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN16'
        ],[
            'id' => 7,
            'nama' => 'Islahnia Gadis',
            'id_kategori' => 3,
            'phone' => '08724375404',
            'kota' => 'Surakarta',
            'jumlah' => '4',
            'total_harga' => '20000',
            'status' => 'Lunas',
            'tanggal' => '06-12-2022',
            'tanggal_pembayaran' => '06-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN17'
        ],[
            'id' => 8,
            'nama' => 'Bima',
            'id_kategori' => 4,
            'phone' => '087575808010',
            'kota' => 'Surakarta',
            'jumlah' => '65',
            'total_harga' => '325000',
            'kehadiran' => "Hadir",
            'tanggal' => '06-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN18'
        ],[
            'id' => 9,
            'nama' => 'Adibah',
            'id_kategori' => 12,
            'phone' => '081122334455',
            'kota' => 'Semarang',
            'jumlah' => '6',
            'total_harga' => '45000',
            'tanggal' => '03-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN19'
        ],[
            'id' => 10,
            'nama' => 'Angga',
            'id_kategori' => 5,
            'phone' => '086060101010',
            'kota' => 'Surakarta',
            'jumlah' => '60',
            'total_harga' => '270000',
            'tanggal' => '04-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => "Udin",
            'id_admin' => null,
            'kode_tiket' => 'MKN110'
        ],[
            'id' => 11,
            'nama' => 'Mala',
            'id_kategori' => 14,
            'phone' => '087755379233',
            'kota' => 'Mojokerto',
            'jumlah' => '5',
            'total_harga' => '0',
            'status' => 'Lunas',
            'tanggal' => '03-12-2022',
            'tanggal_pembayaran' => '03-12-2022',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP211'
        ],[
            'id' => 12,
            'nama' => 'Steven',
            'id_kategori' => 7,
            'phone' => '087744679532',
            'kota' => 'Surakarta',
            'jumlah' => '5',
            'total_harga' => '0',
            'status' => 'Lunas',
            'tanggal' => '01-07-2023',
            'tanggal_pembayaran' => '01-07-2023',
            'kehadiran' => "Hadir",
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP212'
        ],[
            'id' => 13,
            'nama' => 'Soleh',
            'id_kategori' => 3,
            'phone' => '087420853598',
            'kota' => 'Yogyakarta',
            'jumlah' => '4',
            'total_harga' => '20000',
            'tanggal' => '06-01-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => "Udin",
            'id_admin' => null,
            'kode_tiket' => 'MKN113'
        ],[
            'id' => 14,
            'nama' => 'Hayati',
            'id_kategori' => 7,
            'phone' => '0877334271160',
            'kota' => 'Malang',
            'jumlah' => '8',
            'total_harga' => '0',
            'kehadiran' => "Hadir",
            'status' => 'Lunas',
            'tanggal' => '04-01-2023',
            'tanggal_pembayaran' => '04-01-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP214'
        ],[
            'id' => 15,
            'nama' => 'Lesty',
            'id_kategori' => 3,
            'phone' => '0872147012379',
            'kota' => 'Jakarta',
            'jumlah' => '2',
            'status' => 'Lunas',
            'total_harga' => '10000',
            'tanggal' => '04-01-2023',
            'kehadiran' => "Hadir",
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN115'
        ]
        ,[
            'id' => 16,
            'nama' => 'Billar',
            'id_kategori' => 14,
            'phone' => '0832148927190',
            'kota' => 'Madiun',
            'jumlah' => '2',
            'total_harga' => '0',
            'status' => 'Lunas',
            'tanggal' => '05-01-2023',
            'tanggal_pembayaran' => '05-01-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MRP216'
        ]
        ,[
            'id' => 17,
            'nama' => 'Wanwan',
            'id_kategori' => 12,
            'phone' => '0872147012379',
            'kota' => 'Papua',
            'jumlah' => '5',
            'total_harga' => '25000',
            'tanggal' => '04-04-2023',
            'tanggal_pembayaran' => '04-04-2023',
            'email' => 'samuelstev0902@gmail.com',
            'kehadiran' => "Hadir",
            'pembayaran' => 'tunai',
            'status' => 'Lunas',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN117'
        ]
        ,[
            'id' => 18,
            'nama' => 'Roger',
            'id_kategori' => 3,
            'phone' => '0872147012379',
            'kota' => 'Jakarta',
            'jumlah' => '2',
            'total_harga' => '10000',
            'tanggal' => '04-02-2023',
            'tanggal_pembayaran' => '04-02-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'status' => 'Lunas',
            'kehadiran' => "Hadir",
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN118'
        ]
        ,[
            'id' => 19,
            'nama' => 'Samsul',
            'id_kategori' => 3,
            'phone' => '0872147012379',
            'kota' => 'Jakarta',
            'jumlah' => '2',
            'total_harga' => '10000',
            'tanggal' => '04-03-2023',
            'tanggal_pembayaran' => '04-03-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'kehadiran' => "Hadir",
            'status' => 'Lunas',
            'id_admin' => "Udin",
            'kode_tiket' => 'MKN119'
        ]
        ,[
            'id' => 20,
            'nama' => 'Budiman',
            'id_kategori' => 3,
            'phone' => '0872147012379',
            'kota' => 'Jakarta',
            'jumlah' => '2',
            'total_harga' => '10000',
            'tanggal' => '04-03-2023',
            'email' => 'samuelstev0902@gmail.com',
            'pembayaran' => 'tunai',
            'id_admin' => null,
            'kode_tiket' => 'MKN120'
        ]
    ];

    foreach ($pengunjungData as $data) {
        $tanggal = Carbon::createFromFormat('d-m-Y', $data['tanggal']);
        $data['updated_at'] = $tanggal;
        $data['created_at'] = $tanggal;

        transaksi::create($data);
    }
        
    }
}