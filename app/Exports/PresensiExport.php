<?php

namespace App\Exports;

use App\Models\Presensi;
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

class PresensiExport implements FromQuery, WithMapping, WithHeadings, WithTitle, ShouldAutoSize, WithStyles, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function map($presensi): array
    {
        // This example will return 3 rows.
        // First row will have 2 column, the next 2 will have 1 column
        return [
            [
                $presensi->tanggal,
                $presensi->nomor_pegawai,
                $presensi->nama_lengkap,
                $presensi->jabatan,
                $presensi->sektor_area,
                $presensi->jam_masuk,
                $presensi->jam_keluar,
                $presensi->catatan(),
                $presensi->keterangan
            ]
        ];
    }

    public function headings(): array
    {
        return [
            [
                'TABEL PRESENSI'
            ],
            [
                'Tanggal',
                'Nomor Pegawai',
                'Nama Lengkap',
                'Jabatan',
                'Sektor',
                'Jam Masuk',
                'Jam Keluar',
                'Catatan',
                'Keterangan'
            ]
         ];
    }

    use Exportable;

    private $month;
    private $year;

    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year  = $year;
    }

   
    public function query()
    {
        return Presensi::query();
    }

  
    public function title(): string
    {
        return 'Month ' . $this->month;
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
