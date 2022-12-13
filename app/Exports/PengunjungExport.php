<?php

namespace App\Exports;

use App\Models\Pengunjung;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengunjungExport implements FromCollection, WithHeadings  
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pengunjung::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama',
            'Museum',
            'Kategori',
            'Phone',
            'Kota',
            'Negara',
            'jumlah',
            'Harga Awwal',
            'Potongan Harga',
            'Harga Akhir',
            'Tanggal',
            'Attachment',
            'Pembayaran',
            'ID Admin',
            'Status',
        ];
    }
    // public function map($user): array
    // {
    //     return [
    //         $user->nama,
    //         $user->museum,
    //         // Date::dateTimeToExcel($user->created_at),
    //     ];
    // }
}
