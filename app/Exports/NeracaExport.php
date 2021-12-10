<?php

namespace App\Exports;

use App\Models\Neraca;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class NeracaExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    public function map($neraca): array
    {
        return [
            [
                $neraca->nomor_akun,
                $neraca->akun,
                $neraca->deskripsi,
                $neraca->debit,
                $neraca->kredit,
                $neraca->tanggal,
            ]
        ];
    }

    public function headings(): array
    {
        return [
            [
                'TABEL NERACA'
            ],
            [
                'Nomor Transaksi',
                'Transaksi',
                'Deskripsi',
                'Debit',
                'Kredit',
                'Tanggal'
            ]
         ];
    }

    public function query()
    {
        return Neraca::query();
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1       => ['font' => ['bold' => true, 'size' => 16]],

            2       => ['font' => [ 'size' => 14, 'color' => ['argb' => 'FFFFFFFF']]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class=>function(AfterSheet $event) {
  
                $event->sheet->getDelegate()->getStyle('A2:I2')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('00000000');
  
            },
        ];
    }
}
