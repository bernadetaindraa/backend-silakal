<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class PotensiProdukExport implements
    FromArray,
    ShouldAutoSize,
    WithEvents
{
    protected $data;
    protected $request;
    protected $totalPotensiProduk;
    protected $potensiDaerah;
    protected $produkUsaha;
    protected $perKategori;

    public function __construct(
        $data,
        $request,
        $totalPotensiProduk,
        $potensiDaerah,
        $produkUsaha,
        $perKategori
    ) {
        $this->data = $data;
        $this->request = $request;
        $this->totalPotensiProduk = $totalPotensiProduk;
        $this->potensiDaerah = $potensiDaerah;
        $this->produkUsaha = $produkUsaha;
        $this->perKategori = $perKategori;
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
        $rows[] = ['LAPORAN POTENSI & PRODUK KALURAHAN'];
        $rows[] = ['Jalan Kaliurang Km 20, Sawungan, Hargobinangun, Pakem, Sleman, Yogyakarta, 55582'];
        $rows[] = [''];

        $rows[] = [
            'Kategori',
            $this->request->kategori_potensi_produk ?? 'Semua Kategori'
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
        $rows[] = ['STATISTIK POTENSI & PRODUK'];

        $rows[] = [
            'Total Data',
            $this->totalPotensiProduk
        ];

        $rows[] = [
            'Potensi Daerah',
            $this->potensiDaerah
        ];

        $rows[] = [
            'Produk Usaha Daerah',
            $this->produkUsaha
        ];

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | PER KATEGORI
        |--------------------------------------------------------------------------
        */
        $rows[] = ['DATA PER KATEGORI'];

        foreach ($this->perKategori as $kategori => $jumlah) {

            $rows[] = [
                $kategori,
                $jumlah
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
            'Judul',
            'Nama Potensi / Produk',
            'Kategori',
            'Tanggal',
            'Artikel'
        ];

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */
        foreach ($this->data as $index => $item) {

            $rows[] = [
                $index + 1,
                $item->judul_potensi_produk,
                $item->nama_potensi_produk,
                $item->kategori_potensi_produk,
                Carbon::parse($item->tanggal_potensi_produk)->format('d/m/Y'),
                strip_tags($item->artikel_potensi_produk),
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
                            'STATISTIK POTENSI & PRODUK',
                            'DATA PER KATEGORI'
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
                $sheet->getColumnDimension('B')->setWidth(35);
                $sheet->getColumnDimension('C')->setWidth(30);
                $sheet->getColumnDimension('D')->setWidth(25);
                $sheet->getColumnDimension('E')->setWidth(18);
                $sheet->getColumnDimension('F')->setWidth(60);
            }
        ];
    }
}