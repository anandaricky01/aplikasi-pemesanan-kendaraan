<?php

namespace App\Exports;

use App\Models\RiwayatKendaraan;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RiwayatKendaraanExport implements
    WithEvents,
    FromCollection,
    Responsable,
    WithMapping,
    WithHeadings,
    ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    private $fileName = 'Riwayat Kendaraan.xlsx';

    public function collection()
    {
        return RiwayatKendaraan::all();
    }

    public function map($riwayat_kendaraan): array{
        return [

            $riwayat_kendaraan->id,
            $riwayat_kendaraan->kendaraan->plat_no,
            $riwayat_kendaraan->driver->nama,
            $riwayat_kendaraan->user->name,
            $riwayat_kendaraan->kode_kegiatan,
            $riwayat_kendaraan->bbm_liter,
            $riwayat_kendaraan->tanggal_digunakan,
            $riwayat_kendaraan->tanggal_selesai,
            $riwayat_kendaraan->tujuan
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Plat Nomor',
            'Driver',
            'Penanggung Jawab',
            'Kode Kegiatan',
            'BBM/Liter',
            'Tanggal Ekspedisi',
            'Tanggal Selesai',
            'Tujuan',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ]
                ]);
            },
        ];
    }
}
