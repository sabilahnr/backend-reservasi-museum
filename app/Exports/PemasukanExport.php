<?php

namespace App\Exports;

use App\Models\Pengunjung;
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

class PemasukanExport implements FromCollection, WithHeadings ,WithStyles, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $museumName;
    protected $startDateTime;
    protected $endDateTime;

    public function __construct($museumName, $startDateTime, $endDateTime)
    {
        $this->museumName = $museumName;
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
    }
    public function collection()
{
    return Pengunjung::query()
        ->select('tanggal', 'id_admin', 'nama', 'harga_awal')
        ->whereHas('museum', function ($query) {
            $query->where('nama_museum', $this->museumName);
        })
        ->whereBetween('created_at', [$this->startDateTime, $this->endDateTime])
        ->get();
}

public function registerEvents(): array
{
    return [
        AfterSheet::class => function(AfterSheet $event) {
            $event->sheet->getDelegate()->mergeCells('A1:E1')->getStyle('A1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $event->sheet->getDelegate()->getStyle('A3:D3')
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
        1    => ['font' =>['size' => 18], ['bold' => true],['alignment' => 'center']],
        3    =>['font' => ['size' => 13]]
    ];
}


    public function headings(): array
{
    return [
        ['Laporan data Pengunjung UPTD Museum'],
        [''],
        [
            'Tanggal',
            'ID Admin',
            'Nama',
            'Pemasukan',
        ],
    ];
}

}
