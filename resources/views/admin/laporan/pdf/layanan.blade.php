<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        .header {
            width: 100%;
            margin-bottom: 15px;
        }

        .logo {
            width: 80px;
        }

        .judul {
            text-align: center;
        }

        .judul h2,
        .judul h3,
        .judul p {
            margin: 0;
        }

        hr {
            border: 1px solid #000;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .info {
            margin-bottom: 15px;
        }

        .statistik {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .statistik td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        table.laporan {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.laporan th,
        table.laporan td {
            border: 1px solid #000;
            padding: 6px;
        }

        table.laporan th {
            background: #f2f2f2;
            text-align: center;
        }

        .section-title {
            margin-top: 15px;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: bold;
        }

        .ttd {
            width: 250px;
            float: right;
            text-align: center;
            margin-top: 40px;
        }
    </style>

</head>

<body>

    {{-- HEADER --}}
    <table class="header">

        <tr>

            <td width="90">
                <img
                    src="{{ public_path('images/logo-kabupaten.png') }}"
                    class="logo">
            </td>

            <td class="judul">

                <h2>PEMERINTAH KALURAHAN HARGOBINANGUN</h2>

                <h3>
                    LAPORAN PENGAJUAN LAYANAN
                </h3>

                <p>
                    Jalan Kaliurang Km 20, Sawungan, Hargobinangun,
                    Pakem, Sleman, Yogyakarta 55582
                </p>

            </td>

        </tr>

    </table>

    <hr>

    {{-- INFO --}}
    <div class="info">

        <strong>Periode Laporan :</strong>

        @if(request('tanggal_awal') && request('tanggal_akhir'))

            {{ \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y') }}
            s/d
            {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y') }}

        @else

            Seluruh Data

        @endif

        <br>

        <strong>Tanggal Cetak :</strong>
        {{ now()->translatedFormat('d F Y H:i') }}

    </div>

    {{-- STATISTIK STATUS --}}
    <table class="statistik">

        <tr>

            <td>
                <strong>Total</strong>
                <br>
                {{ $totalPengajuan }}
            </td>

            <td>
                <strong>Menunggu</strong>
                <br>
                {{ $menunggu }}
            </td>

            <td>
                <strong>Diverifikasi</strong>
                <br>
                {{ $diverifikasi }}
            </td>

            <td>
                <strong>Diproses</strong>
                <br>
                {{ $diproses }}
            </td>

            <td>
                <strong>Selesai</strong>
                <br>
                {{ $selesai }}
            </td>

            <td>
                <strong>Ditolak</strong>
                <br>
                {{ $ditolak }}
            </td>

        </tr>

    </table>

    {{-- PENGIRIMAN --}}
    <table class="statistik">

        <tr>

            <td>
                <strong>Ambil Langsung</strong>
                <br>
                {{ $ambil }}
            </td>

            <td>
                <strong>Email</strong>
                <br>
                {{ $email }}
            </td>

            <td>
                <strong>Pengajuan Sendiri</strong>
                <br>
                {{ $sendiri }}
            </td>

            <td>
                <strong>Pengajuan Orang Lain</strong>
                <br>
                {{ $orangLain }}
            </td>

        </tr>

    </table>

    {{-- DATA LAYANAN --}}
    <div class="section-title">
        Data Pengajuan Layanan
    </div>

    <table class="laporan">

        <thead>

            <tr>

                <th width="4%">No</th>
                <th width="12%">Nomor</th>
                <th width="16%">Nama Pengaju</th>
                <th width="14%">NIK</th>
                <th width="18%">Jenis Layanan</th>
                <th width="12%">Kategori</th>
                <th width="8%">Tanggal</th>
                <th width="8%">Pengiriman</th>
                <th width="8%">Status</th>

            </tr>

        </thead>

        <tbody>

            @forelse($data as $item)

                <tr>

                    <td align="center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->nomor_layanan }}
                    </td>

                    <td>
                        {{ $item->nama_pengajuan }}
                    </td>

                    <td>
                        {{ $item->nik_pengajuan }}
                    </td>

                    <td>
                        {{ $item->jenis_layanan_label }}
                    </td>

                    <td>
                        {{ ucfirst(str_replace('_',' ', $item->kategori_layanan)) }}
                    </td>

                    <td align="center">
                        {{ \Carbon\Carbon::parse($item->tanggal_layanan)->format('d/m/Y') }}
                    </td>

                    <td align="center">
                        {{ ucfirst($item->pengiriman_layanan) }}
                    </td>

                    <td align="center">
                        {{ ucfirst(str_replace('_',' ', $item->status_layanan)) }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" align="center">
                        Tidak ada data layanan
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- TTD --}}
    <div class="ttd">

        <p>
            Hargobinangun,
            {{ now()->translatedFormat('d F Y') }}
        </p>

        <strong>
            Lurah Kalurahan Hargobinangun
        </strong>

        <br><br><br><br><br>

        <strong>
            Amin Sarjito, S.H.
        </strong>

    </div>

</body>

</html>