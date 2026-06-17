<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LayananExport implements
    FromArray,
    ShouldAutoSize,
    WithEvents
{
    protected $data;
    protected $request;

    protected $totalPengajuan;
    protected $menunggu;
    protected $diverifikasi;
    protected $diproses;
    protected $selesai;
    protected $ditolak;

    protected $ambil;
    protected $email;

    protected $sendiri;
    protected $orangLain;

    public function __construct(
        $data,
        $request,
        $totalPengajuan,
        $menunggu,
        $diverifikasi,
        $diproses,
        $selesai,
        $ditolak,
        $ambil,
        $email,
        $sendiri,
        $orangLain
    ) {
        $this->data = $data;
        $this->request = $request;

        $this->totalPengajuan = $totalPengajuan;
        $this->menunggu = $menunggu;
        $this->diverifikasi = $diverifikasi;
        $this->diproses = $diproses;
        $this->selesai = $selesai;
        $this->ditolak = $ditolak;

        $this->ambil = $ambil;
        $this->email = $email;

        $this->sendiri = $sendiri;
        $this->orangLain = $orangLain;
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
        $rows[] = ['LAPORAN PENGAJUAN LAYANAN'];
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
        | STATISTIK
        |--------------------------------------------------------------------------
        */
        $rows[] = ['STATISTIK LAYANAN'];

        $rows[] = ['Total Pengajuan', $this->totalPengajuan];
        $rows[] = ['Menunggu', $this->menunggu];
        $rows[] = ['Diverifikasi', $this->diverifikasi];
        $rows[] = ['Diproses', $this->diproses];
        $rows[] = ['Selesai', $this->selesai];
        $rows[] = ['Ditolak', $this->ditolak];

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | PENGIRIMAN
        |--------------------------------------------------------------------------
        */
        $rows[] = ['METODE PENGAMBILAN'];

        $rows[] = ['Ambil Langsung', $this->ambil];
        $rows[] = ['Email', $this->email];

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | JENIS PENGAJUAN
        |--------------------------------------------------------------------------
        */
        $rows[] = ['JENIS PENGAJUAN'];

        $rows[] = ['Sendiri', $this->sendiri];
        $rows[] = ['Orang Lain', $this->orangLain];

        $rows[] = [''];

        /*
        |--------------------------------------------------------------------------
        | HEADER TABEL
        |--------------------------------------------------------------------------
        */
        $rows[] = [
            'No',
            'Nomor Layanan',
            'Nama Pengaju',
            'NIK',
            'Jenis Layanan',
            'Kategori',
            'Tanggal',
            'Pengiriman',
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
                $item->nomor_layanan,
                $item->nama_pengajuan,
                $item->nik_pengajuan,
                $item->jenis_layanan_label,
                ucfirst(str_replace('_', ' ', $item->kategori_layanan)),
                Carbon::parse($item->tanggal_layanan)->format('d/m/Y'),
                ucfirst($item->pengiriman_layanan),
                ucfirst(str_replace('_', ' ', $item->status_layanan)),
            ];
        }

        return $rows;
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet;

                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->mergeCells('A3:I3');

                $sheet->getStyle('A1:I3')->applyFromArray([
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

                foreach ($rows as $index => $row) {

                    if (
                        isset($row[0]) &&
                        in_array($row[0], [
                            'STATISTIK LAYANAN',
                            'METODE PENGAMBILAN',
                            'JENIS PENGAJUAN'
                        ])
                    ) {

                        $rowNumber = $index + 1;

                        $sheet->mergeCells("A{$rowNumber}:I{$rowNumber}");

                        $sheet->getStyle(
                            "A{$rowNumber}:I{$rowNumber}"
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

                $sheet->getStyle(
                    "A{$headerRow}:I{$headerRow}"
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

                $lastRow = $headerRow + $this->data->count();

                $sheet->getStyle(
                    "A{$headerRow}:I{$lastRow}"
                )->applyFromArray([

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin'
                        ]
                    ]
                ]);

                $sheet->freezePane(
                    'A' . ($headerRow + 1)
                );

                $sheet->getStyle(
                    "A1:I{$lastRow}"
                )->getAlignment()->setWrapText(true);

                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(22);
                $sheet->getColumnDimension('C')->setWidth(25);
                $sheet->getColumnDimension('D')->setWidth(22);
                $sheet->getColumnDimension('E')->setWidth(35);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(15);
                $sheet->getColumnDimension('H')->setWidth(18);
                $sheet->getColumnDimension('I')->setWidth(18);
            }
        ];
    }
}