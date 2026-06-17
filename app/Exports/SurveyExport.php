<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SurveyExport implements
    FromArray,
    ShouldAutoSize,
    WithEvents
{
    protected $data;
    protected $request;
    protected $nilaiIkm;
    protected $mutu;
    protected $kinerja;
    protected $lakiLaki;
    protected $perempuan;
    protected $pendidikan;

    public function __construct(
        $data,
        $request,
        $nilaiIkm,
        $mutu,
        $kinerja,
        $lakiLaki,
        $perempuan,
        $pendidikan
    ) {
        $this->data = $data;
        $this->request = $request;
        $this->nilaiIkm = $nilaiIkm;
        $this->mutu = $mutu;
        $this->kinerja = $kinerja;
        $this->lakiLaki = $lakiLaki;
        $this->perempuan = $perempuan;
        $this->pendidikan = $pendidikan;
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
        $rows[] = ['LAPORAN SURVEY KEPUASAN MASYARAKAT (IKM)'];
        $rows[] = ['Jalan Kaliurang Km 20, Sawungan, Hargobinangun, Pakem, Sleman, Yogyakarta, 55582'];
        $rows[] = [''];

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
        | IKM
        |--------------------------------------------------------------------------
        */
        $rows[] = ['STATISTIK IKM'];

        $rows[] = [
            'Nilai IKM',
            $this->nilaiIkm
        ];

        $rows[] = [
            'Mutu Pelayanan',
            $this->mutu
        ];

        $rows[] = [
            'Kinerja Unit Pelayanan',
            $this->kinerja
        ];

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | RESPONDEN
        |--------------------------------------------------------------------------
        */
        $rows[] = ['STATISTIK RESPONDEN'];

        $rows[] = [
            'Total Responden',
            $this->data->count()
        ];

        $rows[] = [
            'Laki-laki',
            $this->lakiLaki
        ];

        $rows[] = [
            'Perempuan',
            $this->perempuan
        ];

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | PENDIDIKAN
        |--------------------------------------------------------------------------
        */
        $rows[] = ['PENDIDIKAN RESPONDEN'];

        foreach ($this->pendidikan as $nama => $jumlah) {

            $rows[] = [
                $nama,
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
            'Tanggal',
            'Jenis Layanan',
            'Umur',
            'Jenis Kelamin',
            'Pendidikan',
            'Pekerjaan',
            'Saran Masukan'
        ];

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */
        foreach ($this->data as $index => $item) {

            $rows[] = [
                $index + 1,
                Carbon::parse($item->tanggal_survey)
                    ->format('d/m/Y'),

                $item->jenis_layanan,
                $item->umur_responden,
                $item->jenis_kelamin_responden,
                $item->pendidikan_responden,
                $item->pekerjaan_responden,
                $item->saran_masukan ?? '-',
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
                | KOP LAPORAN
                |--------------------------------------------------------------------------
                */
                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A2:H2');
                $sheet->mergeCells('A3:H3');

                $sheet->setCellValue(
                    'A3',
                    'Jalan Kaliurang Km 20, Sawungan, Hargobinangun, Pakem, Sleman, Yogyakarta, 55582'
                );

                $sheet->getStyle('A1:H3')->applyFromArray([
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

                /*
                |--------------------------------------------------------------------------
                | INFO PERIODE
                |--------------------------------------------------------------------------
                */
                $sheet->getStyle('A5:B6')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => [
                            'rgb' => 'F3F4F6'
                        ]
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | CARI HEADER TABEL
                |--------------------------------------------------------------------------
                */
                $headerRow = 0;

                $rows = $this->array();

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
                | SECTION TITLE
                |--------------------------------------------------------------------------
                */
                foreach ($rows as $index => $row) {

                    if (
                        isset($row[0]) &&
                        in_array($row[0], [
                            'STATISTIK IKM',
                            'STATISTIK RESPONDEN',
                            'PENDIDIKAN RESPONDEN'
                        ])
                    ) {

                        $rowNumber = $index + 1;

                        $sheet->mergeCells("A{$rowNumber}:H{$rowNumber}");

                        $sheet->getStyle(
                            "A{$rowNumber}:H{$rowNumber}"
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
                    "A{$headerRow}:H{$headerRow}"
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
                    ],

                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center'
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | BORDER TABEL
                |--------------------------------------------------------------------------
                */
                $lastRow =
                    $headerRow +
                    $this->data->count();

                $sheet->getStyle(
                    "A{$headerRow}:H{$lastRow}"
                )->applyFromArray([

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
                $sheet->getStyle(
                    "A{$headerRow}:A{$lastRow}"
                )->getAlignment()->setHorizontal('center');

                $sheet->getStyle(
                    "B{$headerRow}:B{$lastRow}"
                )->getAlignment()->setHorizontal('center');

                /*
                |--------------------------------------------------------------------------
                | WRAP TEXT
                |--------------------------------------------------------------------------
                */
                $sheet->getStyle(
                    "A1:H{$lastRow}"
                )->getAlignment()->setWrapText(true);

                /*
                |--------------------------------------------------------------------------
                | FREEZE HEADER
                |--------------------------------------------------------------------------
                */
                $sheet->freezePane(
                    'A' . ($headerRow + 1)
                );

                /*
                |--------------------------------------------------------------------------
                | TINGGI BARIS
                |--------------------------------------------------------------------------
                */
                $sheet->getDefaultRowDimension()
                    ->setRowHeight(20);

                /*
                |--------------------------------------------------------------------------
                | LEBAR KOLOM MANUAL
                |--------------------------------------------------------------------------
                */
                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(15);
                $sheet->getColumnDimension('C')->setWidth(35);
                $sheet->getColumnDimension('D')->setWidth(12);
                $sheet->getColumnDimension('E')->setWidth(18);
                $sheet->getColumnDimension('F')->setWidth(25);
                $sheet->getColumnDimension('G')->setWidth(25);
                $sheet->getColumnDimension('H')->setWidth(40);
            }
        ];
    }
}