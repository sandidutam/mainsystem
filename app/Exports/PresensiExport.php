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

class PresensiExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    // use Exportable;

    // private $presensi;

    // public function __construct(Presensi $presensi)
    // {
    //     $this->presensi = $presensi;
    // }

    // public function collection()
    // {
    //     return $this->presensi->items();
    // }

    public function map($presensi): array
    {
        // This example will return 3 rows.
        // First row will have 2 column, the next 2 will have 1 column
        return [
            [
                $presensi->tanggal,
                $presensi->keterangan,
                $presensi->pegawai->nomor_pegawai,
                $presensi->pegawai->nama_lengkap(),
                $presensi->pegawai->jabatan,
                $presensi->pegawai->sektor_area,
                $presensi->jam_masuk,
                $presensi->jam_keluar,
                $presensi->catatan()
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
                'Keterangan',
                'Nomor Pegawai',
                'Nama Lengkap',
                'Jabatan',
                'Sektor',
                'Jam Masuk',
                'Jam Keluar',
                'Catatan'
            ]
         ];
    }



    public function query()
    {
        return Presensi::query()->whereHas('pegawai');
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
