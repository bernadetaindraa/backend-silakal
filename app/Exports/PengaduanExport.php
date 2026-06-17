<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PengaduanExport implements
    FromArray,
    ShouldAutoSize,
    WithEvents
{
    protected $data;
    protected $request;

    public function __construct($data, $request)
    {
        $this->data = $data;
        $this->request = $request;
    }

    public function array(): array
    {
        $rows = [];

        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */
        $rows[] = ['PEMERINTAH KALURAHAN HARGOBINANGUN'];
        $rows[] = ['LAPORAN PENGADUAN MASYARAKAT'];
        $rows[] = ['Jalan Kaliurang Km 20, Sawungan, Hargobinangun, Pakem, Sleman, Yogyakarta, 55582'];
        $rows[] = [''];
        /*
        |--------------------------------------------------------------------------
        | INFORMASI LAPORAN
        |--------------------------------------------------------------------------
        */
        $rows[] = [
            'Periode',
            $this->request->tanggal_awal && $this->request->tanggal_akhir
                ? Carbon::parse($this->request->tanggal_awal)->format('d/m/Y')
                    . ' s/d ' .
                  Carbon::parse($this->request->tanggal_akhir)->format('d/m/Y')
                : 'Seluruh Data'
        ];

        $rows[] = [
            'Tanggal Cetak',
            now()->format('d/m/Y H:i')
        ];

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */
        $rows[] = [
            'Total',
            'Menunggu',
            'Diproses',
            'Selesai',
            'Ditolak'
        ];

        $rows[] = [
            $this->data->count(),
            $this->data->where('status_pengaduan', 'Menunggu')->count(),
            $this->data->where('status_pengaduan', 'Diproses')->count(),
            $this->data->where('status_pengaduan', 'Selesai')->count(),
            $this->data->where('status_pengaduan', 'Ditolak')->count(),
        ];

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | HEADER TABEL
        |--------------------------------------------------------------------------
        */
        $rows[] = [
            'No',
            'Tanggal',
            'Judul Pengaduan',
            'Nama Pengadu',
            'Kontak',
            'Jenis',
            'Lokasi',
            'Status'
        ];

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */
        foreach ($this->data as $index => $item) {

            $rows[] = [
                $index + 1,
                Carbon::parse($item->tanggal_pengaduan)->format('d/m/Y'),
                $item->judul_pengaduan,
                $item->nama_pengadu,
                $item->kontak_pengadu,
                $item->jenis_pengaduan,
                $item->lokasi_kejadian,
                $item->status_pengaduan,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | TTD
        |--------------------------------------------------------------------------
        */
        $rows[] = [];
        $rows[] = [];
        $rows[] = [];

        $rows[] = [
            '',
            '',
            '',
            '',
            '',
            '',
            'Hargobinangun, ' . now()->format('d/m/Y')
        ];

        $rows[] = [
            '',
            '',
            '',
            '',
            '',
            '',
            'Lurah Hargobinangun'
        ];

        $rows[] = [];
        $rows[] = [];
        $rows[] = [];
        $rows[] = [];

        $rows[] = [
            '',
            '',
            '',
            '',
            '',
            '',
            'Amin Sarjito, S.H.'
        ];

        return $rows;
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet;

                /*
                |--------------------------------------------------------------------------
                | JUDUL
                |--------------------------------------------------------------------------
                */
                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A2:H2');
                $sheet->mergeCells('A3:H3');

                $sheet->getStyle('A1:H3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 15,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],
                ]);

                /*
                |--------------------------------------------------------------------------
                | INFO LAPORAN
                |--------------------------------------------------------------------------
                */
                $sheet->getStyle('A5:B6')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | STATISTIK
                |--------------------------------------------------------------------------
                */
                $sheet->getStyle('A8:E8')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => 'center'
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => [
                            'rgb' => '1D2059'
                        ]
                    ]
                ]);

                $sheet->getStyle('A8:E9')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin'
                        ]
                    ]
                ]);

                $sheet->getStyle('A9:E9')->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center'
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | HEADER TABEL
                |--------------------------------------------------------------------------
                */
                $headerRow = 11;

                $sheet->getStyle("A{$headerRow}:H{$headerRow}")
                    ->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'color' => [
                                'rgb' => 'FFFFFF'
                            ]
                        ],
                        'alignment' => [
                            'horizontal' => 'center',
                            'vertical' => 'center'
                        ],
                        'fill' => [
                            'fillType' => 'solid',
                            'startColor' => [
                                'rgb' => '1D2059'
                            ]
                        ]
                    ]);

                /*
                |--------------------------------------------------------------------------
                | BORDER TABEL
                |--------------------------------------------------------------------------
                */
                $lastDataRow = 11 + $this->data->count();

                $sheet->getStyle("A11:H{$lastDataRow}")
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => 'thin'
                            ]
                        ]
                    ]);

                /*
                |--------------------------------------------------------------------------
                | ALIGNMENT
                |--------------------------------------------------------------------------
                */
                $sheet->getStyle("A12:A{$lastDataRow}")
                    ->getAlignment()
                    ->setHorizontal('center');

                $sheet->getStyle("B12:B{$lastDataRow}")
                    ->getAlignment()
                    ->setHorizontal('center');

                $sheet->getStyle("H12:H{$lastDataRow}")
                    ->getAlignment()
                    ->setHorizontal('center');

                /*
                |--------------------------------------------------------------------------
                | FREEZE HEADER
                |--------------------------------------------------------------------------
                */
                $sheet->freezePane('A12');

                /*
                |--------------------------------------------------------------------------
                | TINGGI BARIS HEADER
                |--------------------------------------------------------------------------
                */
                $sheet->getRowDimension(11)->setRowHeight(25);

                /*
                |--------------------------------------------------------------------------
                | TTD
                |--------------------------------------------------------------------------
                */
                $ttdRow = $lastDataRow + 8;

                $sheet->getStyle("G{$ttdRow}:G" . ($ttdRow + 6))
                    ->getAlignment()
                    ->setHorizontal('center');
            }
        ];
    }
}