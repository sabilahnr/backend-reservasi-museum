<?php

namespace App\Exports;

use App\Models\Pengunjung;
use App\Models\transaksi;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengunjungExport implements FromCollection, WithHeadings, WithStyles, WithEvents, ShouldAutoSize,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $idMuseum;
    protected $startDateTime;
    protected $endDateTime;

    public function __construct($idMuseum, $startDateTime, $endDateTime)
    {
        $this->idMuseum = $idMuseum;
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
    }

    public function collection()
    {
        $query = transaksi::query()
            ->join('kategori', 'transaksis.id_kategori', '=', 'kategori.id')
            ->join('museum', 'kategori.id_museum', '=', 'museum.id')
            ->whereBetween('transaksis.created_at', [$this->startDateTime, $this->endDateTime]);

        if ($this->idMuseum) {
            $query->where('museum.id', $this->idMuseum);
        }

        return $query->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->mergeCells('A1:R1')->getStyle('A1:R1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:R3')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('EBC4C4');
             },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('B2')->getFont()->setBold(true);
        return [
            1    => ['font' =>['size' => 24], ['bold' => true],['alignment' => 'center']],
            3    =>['font' => ['size' => 13]]
        ];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->id,
            $transaksi->nama,
            $transaksi->kategori->museum->nama_museum,
            $transaksi->kategori->nama_kategori,
            $transaksi->phone,
            $transaksi->kota,
            $transaksi->jumlah,
            $transaksi->total_harga,
            $transaksi->tanggal,
            $transaksi->pembayaran,
            $transaksi->id_admin,
            $transaksi->kehadiran,
            $transaksi->status,
            $transaksi->tanggal_pembayaran,
            $transaksi->tanggal_kehadiran,
            $transaksi->created_at,
            $transaksi->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            ['Laporan data Pengunjung UPT Museum Surakarta']   ,
            [''],
            [
                '#',
                'Nama',
                'Museum',
                'Kategori',
                'Phone',
                'Kota',
                'jumlah',
                'Harga Awal',
                'Tanggal Reservasi',
                'Pembayaran',
                'Nama Admin',
                'kehadiran',
                'Status',
                'Tanggal Pembayaran',
                'Tanggal Kehadiran',
                'Created At',
                'Update At',
            ],
        ];
    }
}
