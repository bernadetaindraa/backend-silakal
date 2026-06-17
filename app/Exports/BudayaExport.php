<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BudayaExport implements
    FromArray,
    ShouldAutoSize,
    WithEvents
{
    protected $data;
    protected $request;
    protected $totalKebudayaan;
    protected $perKategori;
    protected $perJenis;

    public function __construct(
        $data,
        $request,
        $totalKebudayaan,
        $perKategori,
        $perJenis
    ) {
        $this->data = $data;
        $this->request = $request;
        $this->totalKebudayaan = $totalKebudayaan;
        $this->perKategori = $perKategori;
        $this->perJenis = $perJenis;
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
        $rows[] = ['LAPORAN DATA KEBUDAYAAN'];
        $rows[] = ['Jalan Kaliurang Km 20, Sawungan, Hargobinangun, Pakem, Sleman, Yogyakarta, 55582'];
        $rows[] = [''];

        $periode = 'Seluruh Data';

        if (
            $this->request->filled('tahun_awal') ||
            $this->request->filled('tahun_akhir')
        ) {
            $periode =
                ($this->request->tahun_awal ?? '-') .
                ' s/d ' .
                ($this->request->tahun_akhir ?? '-');
        }

        $rows[] = [
            'Periode',
            $periode
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
        $rows[] = ['STATISTIK KEBUDAYAAN'];

        $rows[] = [
            'Total Data Kebudayaan',
            $this->totalKebudayaan
        ];

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | PER KATEGORI
        |--------------------------------------------------------------------------
        */
        $rows[] = ['DATA PER KATEGORI'];

        foreach ($this->perKategori as $namaKategori => $total) {

            $rows[] = [
                $namaKategori,
                $total
            ];
        }

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | PER JENIS
        |--------------------------------------------------------------------------
        */
        $rows[] = ['DATA PER JENIS'];

        foreach ($this->perJenis as $namaJenis => $total) {

            $rows[] = [
                $namaJenis,
                $total
            ];
        }

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | HEADER TABEL
        |--------------------------------------------------------------------------
        */
        $rows[] = [
            'No',
            'Judul Kebudayaan',
            'Jenis Kebudayaan',
            'Kategori Kebudayaan',
            'Tahun Ditetapkan',
            'Lokasi'
        ];

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */
        foreach ($this->data as $index => $item) {

            $rows[] = [
                $index + 1,
                $item->judul_kebudayaan,
                $item->jenisKebudayaan->nama_jenis ?? '-',
                $item->jenisKebudayaan->kategoriKebudayaan->nama_kategori ?? '-',
                $item->tahun_ditetapkan,
                $item->lokasi_kebudayaan,
            ];
        }

        return $rows;
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet;

                /*
                |--------------------------------------------------------------------------
                | HEADER
                |--------------------------------------------------------------------------
                */
                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');
                $sheet->mergeCells('A3:F3');

                $sheet->getStyle('A1:F3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);

                $sheet->getStyle('A1')->getFont()->setSize(16);
                $sheet->getStyle('A2')->getFont()->setSize(14);
                $sheet->getStyle('A3')->getFont()->setSize(10);

                $rows = $this->array();

                $headerRow = 0;

                foreach ($rows as $index => $row) {

                    if (
                        isset($row[0]) &&
                        $row[0] === 'No'
                    ) {
                        $headerRow = $index + 1;
                        break;
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | SECTION HEADER
                |--------------------------------------------------------------------------
                */
                foreach ($rows as $index => $row) {

                    if (
                        isset($row[0]) &&
                        in_array($row[0], [
                            'STATISTIK KEBUDAYAAN',
                            'DATA PER KATEGORI',
                            'DATA PER JENIS'
                        ])
                    ) {

                        $rowNumber = $index + 1;

                        $sheet->mergeCells(
                            "A{$rowNumber}:F{$rowNumber}"
                        );

                        $sheet->getStyle(
                            "A{$rowNumber}:F{$rowNumber}"
                        )->applyFromArray([

                            'font' => [
                                'bold' => true,
                                'color' => [
                                    'rgb' => 'FFFFFF'
                                ]
                            ],

                            'fill' => [
                                'fillType' => 'solid',
                                'startColor' => [
                                    'rgb' => '1D4ED8'
                                ]
                            ],

                            'alignment' => [
                                'horizontal' => 'center'
                            ]
                        ]);
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | HEADER TABEL
                |--------------------------------------------------------------------------
                */
                $sheet->getStyle(
                    "A{$headerRow}:F{$headerRow}"
                )->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ]
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
                | BORDER
                |--------------------------------------------------------------------------
                */
                $lastRow = $headerRow + $this->data->count();

                $sheet->getStyle(
                    "A{$headerRow}:F{$lastRow}"
                )->applyFromArray([

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin'
                        ]
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | FREEZE
                |--------------------------------------------------------------------------
                */
                $sheet->freezePane(
                    'A' . ($headerRow + 1)
                );

                /*
                |--------------------------------------------------------------------------
                | WRAP TEXT
                |--------------------------------------------------------------------------
                */
                $sheet->getStyle(
                    "A1:F{$lastRow}"
                )->getAlignment()->setWrapText(true);

                /*
                |--------------------------------------------------------------------------
                | WIDTH
                |--------------------------------------------------------------------------
                */
                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(40);
                $sheet->getColumnDimension('C')->setWidth(25);
                $sheet->getColumnDimension('D')->setWidth(25);
                $sheet->getColumnDimension('E')->setWidth(18);
                $sheet->getColumnDimension('F')->setWidth(40);
            }
        ];
    }
}