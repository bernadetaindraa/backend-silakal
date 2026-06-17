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
            margin-bottom: 15px;
        }

        .statistik td {
            border: 1px solid #000;
            padding: 6px;
        }

        table.laporan {
            width: 100%;
            border-collapse: collapse;
        }

        table.laporan th,
        table.laporan td {
            border: 1px solid #000;
            padding: 6px;
        }

        table.laporan th {
            background: #f2f2f2;
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
                <h3>LAPORAN PENGADUAN MASYARAKAT</h3>

                <p>
                    Jalan Kaliurang Km 20, Sawungan, Hargobinangun, Pakem, Sleman, Yogyakarta, 55582
                </p>

            </td>

        </tr>
    </table>

    <hr>

    {{-- PERIODE --}}
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

    {{-- STATISTIK --}}
    <table class="statistik">

        <tr>
            <td>
                <strong>Total Pengaduan</strong><br>
                {{ $data->count() }}
            </td>

            <td>
                <strong>Menunggu</strong><br>
                {{ $data->where('status_pengaduan','Menunggu')->count() }}
            </td>

            <td>
                <strong>Diproses</strong><br>
                {{ $data->where('status_pengaduan','Diproses')->count() }}
            </td>

            <td>
                <strong>Selesai</strong><br>
                {{ $data->where('status_pengaduan','Selesai')->count() }}
            </td>

            <td>
                <strong>Ditolak</strong><br>
                {{ $data->where('status_pengaduan','Ditolak')->count() }}
            </td>
        </tr>

    </table>

    {{-- TABEL --}}
    <table class="laporan">

        <thead>

            <tr>
                <th width="5%">No</th>
                <th width="25%">Judul</th>
                <th width="18%">Pengadu</th>
                <th width="15%">Jenis</th>
                <th width="15%">Tanggal</th>
                <th width="12%">Status</th>
            </tr>

        </thead>

        <tbody>

            @forelse($data as $item)

            <tr>

                <td align="center">
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->judul_pengaduan }}
                </td>

                <td>
                    {{ $item->nama_pengadu }}
                </td>

                <td>
                    {{ $item->jenis_pengaduan }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_pengaduan)->format('d/m/Y') }}
                </td>

                <td>
                    {{ $item->status_pengaduan }}
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="6" align="center">
                    Tidak ada data
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
            Lurah
        </strong>

        <p>
            <strong>
                Kalurahan Hargobinangun
            </strong>
        </p>
      
        <br><br><br><br>

        <strong>
            Amin Sarjito, S.H.
        </strong>

    </div>

</body>
</html>